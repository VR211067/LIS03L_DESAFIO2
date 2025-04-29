<?php
// Se incluyen los archivos base necesarios
require_once 'Controller.php';              
require_once 'Models/Venta.php';            
require_once 'Models/Producto.php';         
require_once 'Models/Cliente.php';         
require_once 'Models/Usuario.php';          

class IndexController extends Controller {

    // Método que se ejecuta cuando se accede a la raíz del controlador
    public function index() {
        // Redirige a la tienda pública del sitio
        header("Location: /TextilExport/Public/index");
        exit(); 
    }

    // Método que muestra el dashboard del panel de administración
    public function dashboard() {
        // Inicia la sesión
        session_start();

        // Verifica si hay un usuario autenticado en la sesión
        if (!isset($_SESSION['usuario'])) {
            // Si no hay usuario, redirige al login de administrador
            header("Location: /TextilExport/Auth/login");
            exit();
        }

        // Obtiene el nombre y rol del usuario autenticado
        $nombre = $_SESSION['usuario']['nombre'];
        $rol = $_SESSION['usuario']['rol'];

        // Si el rol fuera "cliente" (aunque no se espera aquí), lo redirige a la tienda pública
        if ($rol === 'cliente') {
            header("Location: /TextilExport/Public/tienda");
            exit();
        }

        // Crea instancias de los modelos necesarios para obtener datos del sistema
        $ventaModel = new Venta();
        $productoModel = new Producto();
        $clienteModel = new Cliente();
        $usuarioModel = new Usuario();

        // Obtiene estadísticas generales para mostrar en el dashboard
        $totalVentas = $ventaModel->getTotalVentas();               // Total de ventas realizadas
        $totalProductos = $productoModel->contarProductos();        // Total de productos en catálogo
        $totalClientes = $clienteModel->contarClientes();           // Total de clientes registrados
        $totalUsuarios = $usuarioModel->contarUsuarios();           // Total de usuarios (admins y empleados)

        // Renderiza la vista dashboard.php pasándole los datos estadísticos y del usuario
        $this->render('dashboard.php', [
            'nombre' => $nombre,
            'rol' => $rol,
            'totalVentas' => $totalVentas,
            'totalProductos' => $totalProductos,
            'totalClientes' => $totalClientes,
            'totalUsuarios' => $totalUsuarios
        ]);
    }
}
