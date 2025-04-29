<?php
// Importamos el controlador base y el modelo de Usuario
require_once 'Controller.php';
require_once 'Models/Usuario.php';

// Definimos el controlador para gestionar usuarios (admin)
class UsuariosController extends Controller {

    // Variable para guardar la instancia del modelo Usuario
    private $model;

    // Constructor del controlador: se ejecuta al instanciar el controlador
    public function __construct() {
        session_start();              // Iniciamos la sesión
        $this->model = new Usuario(); // Instanciamos el modelo Usuario
    }

    // Método principal que muestra todos los usuarios
    public function index() {
        $this->authorizeAdmin(); // Verificamos que el usuario sea administrador
        $usuarios = $this->model->getAll(); // Obtenemos todos los usuarios desde el modelo
        $this->render('index.php', ['usuarios' => $usuarios]); // Renderizamos la vista y enviamos los usuarios
    }

    // Método para crear un nuevo usuario
    public function create() {
        $this->authorizeAdmin(); // Verificamos acceso del administrador

        $data = $_POST; // Obtenemos los datos enviados por POST
        $error = "";    // Variable para almacenar errores

        // Verificamos si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Comprobamos si el usuario ya existe
            $existente = $this->model->getByUsuario($data['usuario']);

            if (!empty($existente)) {
                // Si ya existe, mostramos un mensaje de error
                $error = "El nombre de usuario ya existe. Intente con otro.";
            } else {
                // Si no existe, lo creamos
                $this->model->create($data);
                // Redirigimos al listado de usuarios
                header("Location: /TextilExport/Usuarios");
                exit();
            }
        }

        // Si no se envió o hubo error, mostramos el formulario con los datos actuales
        $this->render('create.php', ['data' => $data ?? [], 'error' => $error]);
    }

    // Método para editar un usuario existente
    public function edit($params) {
        $this->authorizeAdmin(); // Verificamos acceso del administrador
        $id = $params; // Obtenemos el ID del usuario a editar

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Si se envió el formulario, actualizamos los datos
            $this->model->update($id, $_POST);
            header("Location: /TextilExport/Usuarios");
            exit();
        }

        // Si no se ha enviado el formulario, obtenemos los datos del usuario
        $usuario = $this->model->getById($id)[0];
        // Mostramos el formulario de edición con los datos del usuario
        $this->render('edit.php', ['usuario' => $usuario]);
    }

    // Método para eliminar un usuario
    public function delete() {
        $this->authorizeAdmin(); // Verificamos acceso del administrador

        // Comprobamos si se envió el formulario por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null; // Obtenemos el ID del usuario a eliminar
            if ($id) {
                $this->model->delete($id); // Eliminamos al usuario
            }
        }

        // Redirigimos al listado de usuarios
        header("Location: /TextilExport/Usuarios");
        exit();
    }

    // Método privado para restringir el acceso solo a administradores
    private function authorizeAdmin() {
        // Verificamos que haya sesión y que el rol del usuario sea "admin"
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            echo "<script>
                    alert('Acceso no autorizado');
                    window.location.href = '/TextilExport/auth/login';
                  </script>";
            exit; 
        }
    }
}
