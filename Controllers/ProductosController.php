<?php
require_once 'Controller.php';
require_once 'Models/Producto.php';
require_once 'Models/Categoria.php';

class ProductosController extends Controller {

    private $productoModel;
    private $categoriaModel;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->categoriaModel = new Categoria();
    }

    public function index() {
        $productos = $this->productoModel->getAll();
        $this->render('index.php', ['productos' => $productos]);
    }

    public function create() {
        $error = null;
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Verificar si ya existe un producto con ese código
            $existente = $this->productoModel->getByCodigo(trim($data['codigo']));
            if (!empty($existente)) {
                $error = "El código '{$data['codigo']}' ya está en uso. Elige otro.";
            } else {
                // Validar precio y existencias
                if (empty($data['precio']) || $data['precio'] < 0) {
                    $error = "El precio debe ser un valor mayor o igual a 0.";
                } elseif (empty($data['existencias']) || $data['existencias'] < 0) {
                    $error = "Las existencias deben ser un valor mayor o igual a 0.";
                } else {
                    // Validar formato de imagen
                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $extensionesPermitidas = ['jpg', 'jpeg', 'png'];

                    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                        $error = "Solo se permiten imágenes en formato JPG o PNG.";
                    } else {
                        // Guardar imagen
                        $imagen = $_FILES['imagen']['name'];
                        $ruta = "Public/uploads/" . $imagen;
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                        $data['imagen'] = $imagen;

                        $this->productoModel->create($data);
                        header("Location: /TextilExport/Productos");
                        exit();
                    }
                }
            }
        }

        $categorias = $this->categoriaModel->getAll();
        $this->render('create.php', ['categorias' => $categorias, 'error' => $error, 'data' => $data]);
    }

    public function edit($params) {
        $id = $params;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Validar precio y existencias
            if (empty($data['precio']) || $data['precio'] < 0) {
                $error = "El precio debe ser un valor mayor o igual a 0.";
            } elseif (empty($data['existencias']) || $data['existencias'] < 0) {
                $error = "Las existencias deben ser un valor mayor o igual a 0.";
            } else {
                if (!empty($_FILES['imagen']['name'])) {
                    // Validar formato de imagen
                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $extensionesPermitidas = ['jpg', 'jpeg', 'png'];

                    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                        $error = "Solo se permiten imágenes en formato JPG o PNG.";
                    } else {
                        $imagen = $_FILES['imagen']['name'];
                        $ruta = "Public/uploads/" . $imagen;
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                        $data['imagen'] = $imagen;
                    }
                } else {
                    $producto = $this->productoModel->getById($id)[0];
                    $data['imagen'] = $producto['imagen'];
                }
            }

            if (!$error) {
                $this->productoModel->update($id, $data);
                header("Location: /TextilExport/Productos");
                exit();
            }
        }

        $producto = $this->productoModel->getById($id)[0];
        $categorias = $this->categoriaModel->getAll();
        $this->render('edit.php', ['producto' => $producto, 'categorias' => $categorias, 'error' => $error]);
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $this->productoModel->delete($id);
            }
        }
        header("Location: /TextilExport/Productos");
        exit();
    }
}
