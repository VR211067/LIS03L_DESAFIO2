<?php
require_once 'Controller.php';
require_once 'Models/Usuario.php';


class AuthController extends Controller {

    private $model;

    public function __construct() {
        session_start();
        $this->model = new Usuario();
    }

    public function login() {
        $error = null;
        $usuario = '';
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
    
            $user = $this->model->getByUsuario($usuario);
            if ($user) {
                if (password_verify($password, $user[0]['password'])) {
                    $_SESSION['usuario'] = $user[0];
                    header("Location: /TextilExport/Index/dashboard");
                    exit();
                } else {
                    $error = "Contraseña inválida.";
                }
            } else {
                $error = "Usuario no encontrado.";
            }
        }
    
        $this->render('login.php', ['error' => $error, 'usuario' => $usuario]);
    }
    
    
    public function logout() {
        session_start();
        session_unset();         // Limpia las variables de sesión
        session_destroy();       // Destruye la sesión
        header("Location: /TextilExport/Auth/login"); // Redirige al login
        exit();
    }
    
    
}
