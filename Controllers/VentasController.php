<?php
require_once 'Controller.php';
require_once 'Models/Venta.php';

class VentasController extends Controller {

    private $model;

    public function __construct() {
        session_start();
        $this->model = new Venta();
    }

    private function authorize() {
        if (!isset($_SESSION['usuario'])) {
            die('Acceso denegado');
        }
    }

    public function index() {
        $this->authorize();
        $ventas = $this->model->getAll();
        $this->render('index.php', ['ventas' => $ventas]);
    }
}
