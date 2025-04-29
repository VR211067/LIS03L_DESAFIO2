<?php
// Se cargan los archivos necesarios para el funcionamiento del controlador
require_once 'Controller.php';
require_once 'Models/Producto.php';
require_once 'Models/Venta.php';
require_once 'Models/DetalleVenta.php';
require_once 'vendor/autoload.php'; 


use Dompdf\Dompdf;


class CarritoController extends Controller {

    private $productoModel;
    private $ventaModel;
    private $detalleVentaModel;

    // Constructor: inicializa modelos y la sesión del carrito
    public function __construct() {
        session_start(); // Inicia la sesión para el manejo de variables globales
        $this->productoModel = new Producto();
        $this->ventaModel = new Venta();
        $this->detalleVentaModel = new DetalleVenta();

        // Si no existe el carrito en sesión, lo inicializa como un arreglo vacío
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    // Agrega un producto al carrito
    public function add() {
        $id = $_POST['producto_id']; // ID del producto recibido por POST
        $cantidad = $_POST['cantidad']; // Cantidad seleccionada

        // Obtiene el producto 
        $producto = $this->productoModel->getById($id)[0];

        // Si el producto existe, lo agrega al carrito en la sesión
        if ($producto) {
            $_SESSION['carrito'][$id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        // Redirige al usuario de regreso a la tienda
        header("Location: /TextilExport/Public/tienda");
    }

    // Elimina un producto del carrito usando su ID // Elimina el producto del carrito// Redirige a la vista del carrito
    public function remove($params) {
        unset($_SESSION['carrito'][$params]); 
        header("Location: /TextilExport/Carrito/ver"); 
    }

    // Muestra el contenido actual del carrito
    public function ver() {
        $this->render('carrito.php', ['carrito' => $_SESSION['carrito']]);
    }

    // Finaliza el proceso de compra
    public function comprar() {
        // Verifica que el cliente haya iniciado sesión
        if (!isset($_SESSION['cliente'])) {
            header("Location: /TextilExport/Public/login");
            exit();
        }

        $cliente_id = $_SESSION['cliente']['id'];
        $carrito = $_SESSION['carrito'];

        // Si el carrito está vacío, se detiene la operación
        if (empty($carrito)) {
            echo "El carrito está vacío.";
            return;
        }

        // Calcula el total a pagar sumando subtotales por producto
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        // Crea una nueva venta en la base de datos
        $venta_id = $this->ventaModel->create([
            'cliente_id' => $cliente_id,
            'total' => $total
        ]);

        // Registra cada producto de la venta en los detalles y actualiza existencias
        foreach ($carrito as $item) {
            $this->detalleVentaModel->create([
                'venta_id' => $venta_id,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);

            // Se actualizan las existencias del producto vendido
            $producto = $this->productoModel->getById($item['id'])[0];
            $nueva_existencia = $producto['existencias'] - $item['cantidad'];
            if ($nueva_existencia < 0) {
                $nueva_existencia = 0; // Evita que existencias negativas
            }

            // Se guarda el nuevo estado del producto
            $this->productoModel->update($item['id'], [
                'codigo' => $producto['codigo'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'imagen' => $producto['imagen'],
                'categoria_id' => $producto['categoria_id'],
                'precio' => $producto['precio'],
                'existencias' => $nueva_existencia
            ]);
        }

        // Genera el comprobante en formato PDF
        $cliente_nombre = $_SESSION['cliente']['nombre'];
        $nombre_pdf = $this->generarComprobantePDF($venta_id, $carrito, $total, $cliente_nombre);

        // Guarda el nombre del comprobante en la base de datos
        $this->ventaModel->guardarComprobante($venta_id, $nombre_pdf);

        // Limpia el carrito y guarda el nombre del último comprobante generado
        $_SESSION['carrito'] = [];
        $_SESSION['ultimo_comprobante'] = $nombre_pdf;

        // Redirige al usuario a la vista donde puede ver o descargar su comprobante
        header("Location: /TextilExport/Carrito/comprobante?archivo=" . urlencode($nombre_pdf));
        exit();
    }

    // Muestra un comprobante en PDF 
    public function comprobante() {
        if (!isset($_GET['archivo'])) {
            echo "No se especificó ningún archivo.";
            return;
        }

        $archivo = basename($_GET['archivo']); // Nombre del archivo recibido por GET
        $ruta_absoluta = $_SERVER['DOCUMENT_ROOT'] . "/TextilExport/Public/uploads/comprobantes/$archivo";

        // Verifica que el archivo exista físicamente
        if (!file_exists($ruta_absoluta)) {
            echo "<h2>Error: el comprobante PDF no fue encontrado.</h2>";
            return;
        }

        // Muestra la vista donde se incrusta el PDF
        $this->render('comprobante.php', ['pdf' => $archivo]);
    }

    // Genera un archivo PDF con los datos de la compra usando DomPDF
    private function generarComprobantePDF($venta_id, $carrito, $total, $cliente_nombre) {
        $dompdf = new Dompdf();

        // Contenido HTML que se convertirá en PDF
        $html = "<div style='text-align: center;'>
                    <h1>TextilExport</h1>
                    <h2>Comprobante de Compra #$venta_id</h2>
                    <h3>Cliente: " . htmlspecialchars($cliente_nombre) . "</h3>
                 </div>
                 <table border='1' cellpadding='5' cellspacing='0' style='width:100%; margin-top:20px;'>
                 <thead>
                 <tr><th>Producto</th><th>Cantidad</th><th>Precio</th></tr>
                 </thead>
                 <tbody>";

        // Agrega al HTML cada producto comprado con su subtotal
        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $html .= "<tr>
                        <td>{$item['nombre']}</td>
                        <td style='text-align:center;'>{$item['cantidad']}</td>
                        <td style='text-align:right;'>$" . number_format($subtotal, 2) . "</td>
                      </tr>";
        }

        // Agrega el total general de la compra
        $html .= "<tr>
                    <td colspan='2' style='text-align:right;'><strong>Total</strong></td>
                    <td style='text-align:right;'><strong>$" . number_format($total, 2) . "</strong></td>
                  </tr>
                 </tbody>
                 </table>";

        // Carga el HTML al objeto DomPDF
        $dompdf->loadHtml($html);
        $dompdf->render(); // Renderiza el contenido como PDF

        // Define el nombre único del archivo PDF
        $filename = "comp-" . time() . ".pdf";
        $ruta = $_SERVER['DOCUMENT_ROOT'] . "/TextilExport/Public/uploads/comprobantes";

        // Crea el directorio si no existe
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        // Guarda el archivo PDF en el servidor
        file_put_contents("$ruta/$filename", $dompdf->output());
        chmod("$ruta/$filename", 0644); // Establece permisos de lectura

        return $filename; // Devuelve el nombre del archivo generado
    }

}
