<?php
require_once 'Controller.php';
require_once 'Models/Cliente.php';

class ClientesController extends Controller {

    private $model;

    public function __construct() {
        session_start();
        $this->model = new Cliente();
    }

    private function authorizeAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            die('Acceso no autorizado');
        }
    }

    public function index() {
        $this->authorizeAdmin();
        $clientes = $this->model->getAll();
        $this->render('index.php', ['clientes' => $clientes]);
    }

    public function edit($params) {
        $this->authorizeAdmin();
        $id = $params;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update($id, $_POST);
            header("Location: /TextilExport/Clientes");
            exit();
        }
        $cliente = $this->model->getById($id)[0];
        $this->render('edit.php', ['cliente' => $cliente]);
    }

    public function delete($params) {
        $this->authorizeAdmin();
        $id = $params;
        $this->model->delete($id);
        header("Location: /TextilExport/Clientes");
        exit();
    }
    
}
