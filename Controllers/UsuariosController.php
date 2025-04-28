<?php
require_once 'Controller.php';
require_once 'Models/Usuario.php';

class UsuariosController extends Controller {

    private $model;

    public function __construct() {
        session_start();
        $this->model = new Usuario();
    }

    public function index() {
        $this->authorizeAdmin();
        $usuarios = $this->model->getAll();
        $this->render('index.php', ['usuarios' => $usuarios]);
    }

    public function create() {
        $this->authorizeAdmin();
    
        $data = $_POST;
        $error = "";
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $existente = $this->model->getByUsuario($data['usuario']);
    
            if (!empty($existente)) {
                $error = "El nombre de usuario ya existe. Intente con otro.";
            } else {
                $this->model->create($data);
                header("Location: /TextilExport/Usuarios");
                exit();
            }
        }
    
        $this->render('create.php', ['data' => $data ?? [], 'error' => $error]);
    }
    

    public function edit($params) {
        $this->authorizeAdmin();
        $id = $params;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update($id, $_POST);
            header("Location: /TextilExport/Usuarios");
            exit();
        }
        $usuario = $this->model->getById($id)[0];
        $this->render('edit.php', ['usuario' => $usuario]);
    }

    public function delete($params) {
        $this->authorizeAdmin();
        $id = $params[0];
        $this->model->delete($id);
        header("Location: /TextilExport/Usuarios");
        exit();
    }

    private function authorizeAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            echo "<script>
                    alert('Acceso no autorizado');
                    window.location.href = '/TextilExport/auth/login';
                  </script>";
            exit;
        }
    }
    
    
    
    
}
