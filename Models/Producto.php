<?php
require_once 'Model.php';

class Producto extends Model {

    // Método para obtener todos los productos con su respectiva categoría
    public function getAll() {
        return $this->get_query("SELECT p.*, c.nombre AS categoria FROM productos p LEFT JOIN categorias c ON p.categoria_id = c.id");
    }

     // Método para obtener un producto por su ID
    public function getById($id) {
        return $this->get_query("SELECT * FROM productos WHERE id = ?", [$id]);
    }

    // Método para crear un nuevo producto
    public function create($data) {
        return $this->set_query(
            "INSERT INTO productos (codigo, nombre, descripcion, imagen, categoria_id, precio, existencias)
             VALUES (?, ?, ?, ?, ?, ?, ?)",
            [
                $data['codigo'], $data['nombre'], $data['descripcion'],
                $data['imagen'], $data['categoria_id'],
                $data['precio'], $data['existencias']
            ]
        );
    }
    
    // Método para actualizar un producto existente por ID
    public function update($id, $data) {
        return $this->set_query(
            "UPDATE productos SET codigo = ?, nombre = ?, descripcion = ?, imagen = ?, categoria_id = ?, precio = ?, existencias = ? WHERE id = ?",
            [
                $data['codigo'], $data['nombre'], $data['descripcion'],
                $data['imagen'], $data['categoria_id'],
                $data['precio'], $data['existencias'], $id
            ]
        );
    }

    // Método para eliminar un producto por su ID
    public function delete($id) {
        return $this->set_query("DELETE FROM productos WHERE id = ?", [$id]);
    }
    
    // Método para contar el número total de productos
    public function contarProductos() {
        $result = $this->get_query("SELECT COUNT(*) as total FROM productos");
        return $result[0]['total'] ?? 0;
    }
    
    // Método para buscar un producto por su código
    public function getByCodigo($codigo) {
        return $this->get_query("SELECT * FROM productos WHERE codigo = ?", [$codigo]);
    }

    // Método para actualizar solo las existencias de un producto
    public function actualizarExistencias($id, $nueva_existencia) {
        return $this->set_query(
            "UPDATE productos SET existencias = ? WHERE id = ?",
            [$nueva_existencia, $id]
        );
    }

     // Método para obtener productos por categoría
    public function getByCategoria($categoria_id) {
        return $this->get_query(
            "SELECT p.*, c.nombre AS categoria FROM productos p 
             LEFT JOIN categorias c ON p.categoria_id = c.id 
             WHERE p.categoria_id = ?", 
            [$categoria_id]
        );
    }
    
    
    
}
