<?php
// controlador base, modelo Cliente
require_once 'Controller.php';
require_once 'Models/Cliente.php';

class ClientesController extends Controller {

    private $model;

    // Constructor: inicia la sesión y crea una instancia del modelo Cliente
    public function __construct() {
        session_start();
        $this->model = new Cliente();
    }

    // Función privada para restringir acceso solo a usuarios con rol 'admin'
    private function authorizeAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            die('Acceso no autorizado'); // Si no es admin, se detiene la ejecución
        }
    }

    // Método para mostrar la lista de clientes (solo admins pueden acceder)
    public function index() {
        $this->authorizeAdmin(); // Verifica permisos
        $clientes = $this->model->getAll(); // Obtiene todos los clientes
        $this->render('index.php', ['clientes' => $clientes]); // Muestra la vista con los datos
    }

    // Método para editar los datos de un cliente
    public function edit($params) {
        $this->authorizeAdmin(); // Verifica permisos
        $id = $params; // Obtiene el ID del cliente 

        // Si se envió el formulario por POST, actualiza los datos
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update($id, $_POST); // Actualiza usando los datos del formulario
            header("Location: /TextilExport/Clientes"); // Redirige al índice
            exit();
        }

        // Si no se envió POST, obtiene los datos actuales del cliente
        $cliente = $this->model->getById($id)[0];
        $this->render('edit.php', ['cliente' => $cliente]); // Muestra el formulario de edición
    }

    // Método para eliminar un cliente
    public function delete($params) {
        $this->authorizeAdmin(); // Verifica permisos
        $id = $params; // Obtiene el ID del cliente
        $this->model->delete($id); // Elimina el cliente
        header("Location: /TextilExport/Clientes");
        exit();
    }

}
