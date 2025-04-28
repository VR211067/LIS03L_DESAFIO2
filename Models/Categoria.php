<?php
require_once 'Model.php';

class Categoria extends Model {
    
    public function getAll() {
        return $this->get_query("SELECT * FROM categorias");
    }

    public function getById($id) {
        return $this->get_query("SELECT * FROM categorias WHERE id = ?", [$id]);
    }

    public function create($nombre) {
        return $this->set_query("INSERT INTO categorias (nombre) VALUES (?)", [$nombre]);
    }

    public function update($id, $nombre) {
        return $this->set_query("UPDATE categorias SET nombre = ? WHERE id = ?", [$nombre, $id]);
    }

    public function delete($id) {
        return $this->set_query("DELETE FROM categorias WHERE id = ?", [$id]);
    }
    public function getByNombre($nombre) {
        return $this->get_query("SELECT * FROM categorias WHERE TRIM(LOWER(nombre)) = TRIM(LOWER(?))", [$nombre]);
    }
    
}
