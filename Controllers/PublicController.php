<?php
require_once 'Controller.php';
require_once 'Models/Cliente.php';
require_once 'Models/Producto.php';
require_once 'Models/Categoria.php'; 


class PublicController extends Controller {

    private $clienteModel;
    private $productoModel;
    private $categoriaModel; // <-- Declaramos aquí también

    public function __construct() {
        session_start();
        $this->clienteModel = new Cliente();
        $this->productoModel = new Producto();
        $this->categoriaModel = new Categoria(); // <-- Instanciamos aquí
    }

    public function tienda() {
        $categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : null;

        if ($categoria_id) {
            $productos = $this->productoModel->getByCategoria($categoria_id);
        } else {
            $productos = $this->productoModel->getAll();
        }

        $categorias = $this->categoriaModel->getAll(); // <-- Traemos las categorías
        $this->render('tienda.php', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $cliente = $this->clienteModel->getByEmail($email);
            if ($cliente && $cliente[0]['activo'] && password_verify($password, $cliente[0]['password'])) {
                $_SESSION['cliente'] = $cliente[0];
                header("Location: /TextilExport/Public/tienda");
                exit();
            } else {
                $error = "Credenciales inválidas o cliente inhabilitado.";
                $this->render('login.php', ['error' => $error, 'email' => $email ]);
                return;
            }
        }
        $this->render('login.php');
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: /TextilExport/Public/login");
        exit();
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            $existe = $this->clienteModel->getByEmail($data['email']);
            if ($existe) {
                $error = "El correo ya está registrado.";
                $this->render('registro.php', ['error' => $error]);
                return;
            }
            $this->clienteModel->create($data);
            header("Location: /TextilExport/Public/login");
            exit();
        }
        $this->render('registro.php');
    }

    public function index()
        {
            require_once 'Views/Public/index.php';
        }

}
