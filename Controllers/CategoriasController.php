<?php
// controlador base, modelo de categoría
require_once 'Controller.php';
require_once 'Models/Categoria.php';

class CategoriasController extends Controller {

    private $model;

    // Constructor: instancia el modelo de categorías
    public function __construct() {
        $this->model = new Categoria();
    }

    // Método por defecto, todas las categorías
    public function index() {
        $categorias = $this->model->getAll(); // Obtiene todas las categorías
        $this->render('index.php', ['categorias' => $categorias]); // Carga la vista index.php con los datos
    }

    // Método para crear una nueva categoría
    public function create() {
        $error = null; //  variable de error
    
        // Verifica si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']); // Limpia el nombre recibido
    
            // Verifica categoría con ese nombre
            $existente = $this->model->getByNombre($nombre);
            if (!empty($existente)) {
                $error = "La categoría '$nombre' ya existe."; 
            } else {
                // Crea la nueva categoría
                $this->model->create($nombre);
                header("Location: /TextilExport/Categorias"); // Redirige al índice
                exit();
            }
        }
    
        // Renderiza el formulario con mensaje de error
        $this->render('create.php', ['error' => $error]);
    }

    // Método para editar una categoría existente
    public function edit($params) {
        $id = $params; // Recibe el ID como parámetro en la URL
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre']; // Obtiene el nuevo nombre
            $this->model->update($id, $nombre); // Actualiza en la base de datos
            header("Location: /TextilExport/Categorias"); // Redirige al índice
            exit();
        }

        // Si no es POST, obtiene los datos actuales para mostrarlos en el formulario
        $categoria = $this->model->getById($id)[0];
        $this->render('edit.php', ['categoria' => $categoria]); // Muestra el formulario con los datos
    }

    // Método para eliminar una categoría
    public function delete($params = []) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null; // Toma el ID del formulario (si existe)
            if ($id) {
                $this->model->delete($id); // Elimina la categoría de la base de datos
            }
        }
        header("Location: /TextilExport/Categorias"); // Redirige al índice
        exit();
    }
}
