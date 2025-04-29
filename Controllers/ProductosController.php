<?php
// Requiere el controlador base y los modelos necesarios
require_once 'Controller.php';
require_once 'Models/Producto.php';
require_once 'Models/Categoria.php';

class ProductosController extends Controller {

    // Propiedades privadas para acceder a los modelos
    private $productoModel;
    private $categoriaModel;

    // Constructor: crea instancias de los modelos
    public function __construct() {
        $this->productoModel = new Producto();
        $this->categoriaModel = new Categoria();
    }

    // Muestra el listado de todos los productos
    public function index() {
        $productos = $this->productoModel->getAll(); // Obtiene todos los productos
        $this->render('index.php', ['productos' => $productos]); // Renderiza la vista index
    }

    // Muestra el formulario de creación y procesa el envío del formulario
    public function create() {
        $error = null;
        $data = [];

        // Si el formulario fue enviado (POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Verifica si ya existe un producto con el mismo código
            $existente = $this->productoModel->getByCodigo(trim($data['codigo']));
            if (!empty($existente)) {
                $error = "El código '{$data['codigo']}' ya está en uso. Elige otro.";
            } else {
                // Valida que el precio sea un número válido
                if (empty($data['precio']) || $data['precio'] < 0) {
                    $error = "El precio debe ser un valor mayor o igual a 0.";
                }
                // Valida que las existencias también sean válidas
                elseif (empty($data['existencias']) || $data['existencias'] < 0) {
                    $error = "Las existencias deben ser un valor mayor o igual a 0.";
                } else {
                    // Verifica que la imagen tenga un formato permitido
                    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                    $extensionesPermitidas = ['jpg', 'jpeg', 'png'];

                    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                        $error = "Solo se permiten imágenes en formato JPG o PNG.";
                    } else {
                        // Guarda la imagen en la carpeta correspondiente
                        $imagen = $_FILES['imagen']['name'];
                        $ruta = "Public/uploads/" . $imagen;
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);
                        $data['imagen'] = $imagen;

                        // Crea el producto en la base de datos
                        $this->productoModel->create($data);
                        header("Location: /TextilExport/Productos");
                        exit();
                    }
                }
            }
        }

        // Si hubo error o aún no se envió el formulario, se cargan las categorías y se muestra el formulario
        $categorias = $this->categoriaModel->getAll();
        $this->render('create.php', ['categorias' => $categorias, 'error' => $error, 'data' => $data]);
    }

    // Muestra el formulario para editar un producto y procesa la actualización
    public function edit($params) {
        $id = $params;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Validación del precio y existencias
            if (empty($data['precio']) || $data['precio'] < 0) {
                $error = "El precio debe ser un valor mayor o igual a 0.";
            } elseif (empty($data['existencias']) || $data['existencias'] < 0) {
                $error = "Las existencias deben ser un valor mayor o igual a 0.";
            } else {
                // Si se subió una nueva imagen, se valida y guarda
                if (!empty($_FILES['imagen']['name'])) {
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
                    // Si no se sube nueva imagen, se conserva la existente
                    $producto = $this->productoModel->getById($id)[0];
                    $data['imagen'] = $producto['imagen'];
                }
            }

            // Si no hay errores, se actualiza el producto
            if (!$error) {
                $this->productoModel->update($id, $data);
                header("Location: /TextilExport/Productos");
                exit();
            }
        }

        // Si aún no se ha enviado el formulario o hubo errores, se muestran los datos actuales
        $producto = $this->productoModel->getById($id)[0];
        $categorias = $this->categoriaModel->getAll();
        $this->render('edit.php', ['producto' => $producto, 'categorias' => $categorias, 'error' => $error]);
    }

    // Elimina un producto
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null; // Se obtiene el id desde el formulario
            if ($id) {
                $this->productoModel->delete($id); // Se elimina el producto
            }
        }
        header("Location: /TextilExport/Productos"); // Se redirige al listado
        exit();
    }
}
