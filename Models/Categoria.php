<?php
require_once 'Model.php';

class Categoria extends Model {

    // Método para obtener todas las categorías
    
    public function getAll() {
        return $this->get_query("SELECT * FROM categorias");
    }
    // Método para obtener una categoría por su ID
    public function getById($id) {
        return $this->get_query("SELECT * FROM categorias WHERE id = ?", [$id]);
    }
    // Método para crear una nueva categoría
    public function create($nombre) {
        return $this->set_query("INSERT INTO categorias (nombre) VALUES (?)", [$nombre]);
    }
    // Método para actualizar una categoría existente
    public function update($id, $nombre) {
        return $this->set_query("UPDATE categorias SET nombre = ? WHERE id = ?", [$nombre, $id]);
    }
    // Método para eliminar una categoría por su ID
    public function delete($id) {
        return $this->set_query("DELETE FROM categorias WHERE id = ?", [$id]);
    }
    // Método para obtener una categoría por su nombre
    public function getByNombre($nombre) {
        return $this->get_query("SELECT * FROM categorias WHERE TRIM(LOWER(nombre)) = TRIM(LOWER(?))", [$nombre]);
    }
    
}
