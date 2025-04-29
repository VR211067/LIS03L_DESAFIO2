<?php

require_once 'Controller.php';
require_once 'Models/Cliente.php';
require_once 'Models/Producto.php';
require_once 'Models/Categoria.php';


class PublicController extends Controller {


    private $clienteModel;
    private $productoModel;
    private $categoriaModel;

 
    public function __construct() {
        session_start(); // Iniciamos la sesión
        $this->clienteModel = new Cliente();        // Instanciamos el modelo de Cliente
        $this->productoModel = new Producto();      // Instanciamos el modelo de Producto
        $this->categoriaModel = new Categoria();    // Instanciamos el modelo de Categoría
    }

    // Método para mostrar la tienda
    public function tienda() {
        // Obtenemos el ID de la categoría desde la URL (si está presente)
        $categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : null;

        // Si se seleccionó una categoría, filtramos productos por ella
        if ($categoria_id) {
            $productos = $this->productoModel->getByCategoria($categoria_id);
        } else {
            // Si no, mostramos todos los productos
            $productos = $this->productoModel->getAll();
        }

        // Obtenemos todas las categorías para mostrarlas en el filtro
        $categorias = $this->categoriaModel->getAll();

        // Renderizamos la vista 'tienda.php' con los datos obtenidos
        $this->render('tienda.php', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    // Método para el inicio de sesión
    public function login() {
        // Verificamos si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Buscamos al cliente por su correo
            $cliente = $this->clienteModel->getByEmail($email);

            // Validamos que exista, que esté activo y que la contraseña sea correcta
            if ($cliente && $cliente[0]['activo'] && password_verify($password, $cliente[0]['password'])) {
                // Guardamos los datos del cliente en la sesión
                $_SESSION['cliente'] = $cliente[0];
                // Redirigimos a la tienda
                header("Location: /TextilExport/Public/tienda");
                exit();
            } else {
                // Si las credenciales no son válidas o el cliente está inhabilitado, mostramos error
                $error = "Credenciales inválidas o cliente inhabilitado.";
                $this->render('login.php', ['error' => $error, 'email' => $email ]);
                return;
            }
        }
        // Si no se ha enviado el formulario, simplemente mostramos la vista de login
        $this->render('login.php');
    }

    // Método para cerrar sesión
    public function logout() {
        session_start();     // Aseguramos que la sesión esté iniciada
        session_unset();     // Eliminamos todas las variables de sesión
        session_destroy();   // Destruimos la sesión
        header("Location: /TextilExport/Public/login"); // Redirigimos al login
        exit();
    }

    // Método para registrar un nuevo cliente
    public function registro() {
        // Verificamos si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Validamos que el correo no esté ya registrado
            $existe = $this->clienteModel->getByEmail($data['email']);
            if ($existe) {
                $error = "El correo ya está registrado.";
                $this->render('registro.php', ['error' => $error]);
                return;
            }

            // Creamos al nuevo cliente
            $this->clienteModel->create($data);

            // Redirigimos al login
            header("Location: /TextilExport/Public/login");
            exit();
        }

        // Si no se envió el formulario, mostramos la vista de registro
        $this->render('registro.php');
    }

    // Método para cargar la vista principal (landing page)
    public function index() {
        require_once 'Views/Public/index.php'; // Mostramos la vista index directamente
    }

}
