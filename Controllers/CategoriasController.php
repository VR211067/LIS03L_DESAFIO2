<?php
require_once 'Controller.php';
require_once 'Models/Categoria.php';

class CategoriasController extends Controller {

    private $model;

    public function __construct() {
        $this->model = new Categoria();
    }

    public function index() {
        $categorias = $this->model->getAll();
        $this->render('index.php', ['categorias' => $categorias]);
    }

    public function create() {
        $error = null;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre']);
    
            // Validar si ya existe
            $existente = $this->model->getByNombre($nombre);
            if (!empty($existente)) {
                $error = "La categoría '$nombre' ya existe.";
            } else {
                $this->model->create($nombre);
                header("Location: /TextilExport/Categorias");
                exit();
            }
        }
    
        $this->render('create.php', ['error' => $error]);
    }
    

    public function edit($params) {
        $id = $params;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $this->model->update($id, $nombre);
            header("Location: /TextilExport/Categorias");
            exit();
        }
        $categoria = $this->model->getById($id)[0];
        $this->render('edit.php', ['categoria' => $categoria]);
    }

    public function delete($params = []) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null; // Leemos el id enviado por el formulario
            if ($id) {
                $this->model->delete($id);
            }
        }
        header("Location: /TextilExport/Categorias");
        exit();
    }
    
    
}
