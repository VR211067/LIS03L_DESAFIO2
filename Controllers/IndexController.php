<?php
require_once 'Controller.php';
require_once 'models/Venta.php';
require_once 'models/Producto.php';
require_once 'models/Cliente.php';
require_once 'models/Usuario.php';

class IndexController extends Controller {

    // Redirección inicial a la tienda pública
    public function index() {
        header("Location: /TextilExport/Public/index");
        exit();
    }

    // Dashboard del panel de administración
    public function dashboard() {
        session_start();

        // Verifica si hay un usuario en sesión
        if (!isset($_SESSION['usuario'])) {
            header("Location: /TextilExport/Auth/login");
            exit();
        }

        $nombre = $_SESSION['usuario']['nombre'];
        $rol = $_SESSION['usuario']['rol'];

        // Si existiera un rol "cliente", puedes excluirlo aquí
        if ($rol === 'cliente') {
            header("Location: /TextilExport/Public/tienda");
            exit();
        }

        // Obtener estadísticas para mostrar en el dashboard
        $ventaModel = new Venta();
        $productoModel = new Producto();
        $clienteModel = new Cliente();
        $usuarioModel = new Usuario();

        $totalVentas = $ventaModel->getTotalVentas();
        $totalProductos = $productoModel->contarProductos();
        $totalClientes = $clienteModel->contarClientes();
        $totalUsuarios = $usuarioModel->contarUsuarios();

        // Renderiza la vista del dashboard con los datos
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
