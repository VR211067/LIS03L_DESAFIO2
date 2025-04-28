<?php
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

    public function __construct() {
        session_start();
        $this->productoModel = new Producto();
        $this->ventaModel = new Venta();
        $this->detalleVentaModel = new DetalleVenta();

        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function add() {
        $id = $_POST['producto_id'];
        $cantidad = $_POST['cantidad'];

        $producto = $this->productoModel->getById($id)[0];
        if ($producto) {
            $_SESSION['carrito'][$id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }

        header("Location: /TextilExport/Public/tienda");
    }

    public function remove($params) {
        unset($_SESSION['carrito'][$params]);
        header("Location: /TextilExport/Carrito/ver");
    }

    public function ver() {
        $this->render('carrito.php', ['carrito' => $_SESSION['carrito']]);
    }

    public function comprar() {
        if (!isset($_SESSION['cliente'])) {
            header("Location: /TextilExport/Public/login");
            exit();
        }
    
        $cliente_id = $_SESSION['cliente']['id'];
        $carrito = $_SESSION['carrito'];
    
        if (empty($carrito)) {
            echo "El carrito está vacío.";
            return;
        }
    
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
    
        $venta_id = $this->ventaModel->create([
            'cliente_id' => $cliente_id,
            'total' => $total
        ]);
    
        foreach ($carrito as $item) {
            // Crear detalle de venta
            $this->detalleVentaModel->create([
                'venta_id' => $venta_id,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);
    
            // Descontar existencias del producto
            $producto = $this->productoModel->getById($item['id'])[0];
            $nueva_existencia = $producto['existencias'] - $item['cantidad'];
    
            if ($nueva_existencia < 0) {
                $nueva_existencia = 0;
            }
    
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
    
        $nombre_pdf = $this->generarComprobantePDF($venta_id, $carrito, $total);
        $this->ventaModel->guardarComprobante($venta_id, $nombre_pdf);
    
        $_SESSION['carrito'] = [];
        $_SESSION['ultimo_comprobante'] = $nombre_pdf;
    
        header("Location: /TextilExport/Carrito/comprobante?archivo=" . urlencode($nombre_pdf));
        exit();
    }
    

    public function comprobante() {
        if (!isset($_GET['archivo'])) {
            echo "No se especificó ningún archivo.";
            return;
        }

        $archivo = basename($_GET['archivo']);
        $ruta_absoluta = $_SERVER['DOCUMENT_ROOT'] . "/TextilExport/Public/uploads/comprobantes/$archivo";

        if (!file_exists($ruta_absoluta)) {
            echo "<h2>Error: el comprobante PDF no fue encontrado.</h2>";
            return;
        }

        // Renderizar la vista ubicada en Views/Carrito/comprobante.php
        $this->render('comprobante.php', ['pdf' => $archivo]);
    }

    private function generarComprobantePDF($venta_id, $carrito, $total) {
        $dompdf = new Dompdf();
        $html = "<h2>Comprobante de Compra #$venta_id</h2>
                 <table border='1' cellpadding='5' cellspacing='0'>
                 <tr><th>Producto</th><th>Cantidad</th><th>Precio</th></tr>";

        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $html .= "<tr><td>{$item['nombre']}</td><td>{$item['cantidad']}</td><td>$" . number_format($subtotal, 2) . "</td></tr>";
        }

        $html .= "<tr><td colspan='2'><strong>Total</strong></td><td><strong>$" . number_format($total, 2) . "</strong></td></tr>";
        $html .= "</table>";

        $dompdf->loadHtml($html);
        $dompdf->render();

        $filename = "comp-" . time() . ".pdf";
        $ruta = $_SERVER['DOCUMENT_ROOT'] . "/TextilExport/Public/uploads/comprobantes";

        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }

        file_put_contents("$ruta/$filename", $dompdf->output());
        chmod("$ruta/$filename", 0644);

        return $filename;
    }
}
