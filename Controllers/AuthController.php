<?php
// controlador base, modelo Usuario
require_once 'Controller.php';
require_once 'Models/Usuario.php';

class AuthController extends Controller {

    private $model;

    public function __construct() {
        session_start(); // Inicia o continúa la sesión
        $this->model = new Usuario(); // Instancia el modelo Usuario para acceder a métodos de base de datos
    }

    // Método para manejar el inicio de sesión
    public function login() {
        $error = null;       
        $usuario = ''; // Variable para recordar el nombre de usuario ingresado en el formulario
    
        // Verifica si el formulario fue enviado por POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];       // Obtiene Usuario
            $password = $_POST['password'];     // Obtiene Password
    
            
            $user = $this->model->getByUsuario($usuario);
            if ($user) {
                // Verifica contraseña ingresada 
                if (password_verify($password, $user[0]['password'])) {
                    $_SESSION['usuario'] = $user[0]; // Guarda los datos del usuario en la sesión
                    header("Location: /TextilExport/Index/dashboard"); // Redirige al dashboard
                    exit(); 
                } else {
                    $error = "Contraseña inválida."; 
                }
            } else {
                $error = "Usuario no encontrado."; 
            }
        }
    
        // render para vista de login 
        $this->render('login.php', ['error' => $error, 'usuario' => $usuario]);
    }

    // Método para cerrar sesión
    public function logout() {
        session_start();    // verifica sesión activa
        session_unset();    // Elimina todas las variables de sesión
        session_destroy();  // Destruye la sesión 
        header("Location: /TextilExport/Auth/login"); 
        exit();             
    }

}
