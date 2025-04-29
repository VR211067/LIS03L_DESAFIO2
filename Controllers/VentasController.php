<?php

require_once 'Controller.php';
require_once 'Models/Venta.php';


class VentasController extends Controller {

 
    private $model;

    // Constructor 
    public function __construct() {
        session_start();         // Iniciamos la sesión
        $this->model = new Venta(); // Instanciamos el modelo de ventas
    }

    // Método privado para verificar si el usuario ha iniciado sesión
    private function authorize() {
        // Si no hay un usuario en la sesión, se niega el acceso
        if (!isset($_SESSION['usuario'])) {
            die('Acceso denegado'); // Detiene la ejecución y muestra mensaje
        }
    }

    // Método principal que muestra todas las ventas
    public function index() {
        $this->authorize(); // Verificamos que haya un usuario autenticado
        $ventas = $this->model->getAll(); // Obtenemos todas las ventas desde el modelo
        $this->render('index.php', ['ventas' => $ventas]);
    }
}
