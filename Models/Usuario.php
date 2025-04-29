<?php
require_once 'Model.php';

class Usuario extends Model {

    // Método para obtener un usuario por su nombre de usuario 
    public function getByUsuario($usuario) {
        return $this->get_query("SELECT * FROM usuarios WHERE usuario = ?", [$usuario]);
    }

    // Método para obtener todos los usuarios
    public function getAll() {
        return $this->get_query("SELECT * FROM usuarios");
    }

    // Método para obtener un usuario por su ID
    public function getById($id) {
        return $this->get_query("SELECT * FROM usuarios WHERE id = ?", [$id]);
    }

    // Método para crear un nuevo usuario
    public function create($data) {

        // Encripta la contraseña con BCRYPT antes de guardarla en la base de datos
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->set_query(
            "INSERT INTO usuarios (nombre, usuario, password, rol) VALUES (?, ?, ?, ?)",
            [$data['nombre'], $data['usuario'], $data['password'], $data['rol']]
        );
    }

    // Método para actualizar los datos de un usuario
    public function update($id, $data) {
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            return $this->set_query(
                "UPDATE usuarios SET nombre = ?, usuario = ?, password = ?, rol = ? WHERE id = ?",
                [$data['nombre'], $data['usuario'], $data['password'], $data['rol'], $id]
            );
        } else {
            return $this->set_query(
                "UPDATE usuarios SET nombre = ?, usuario = ?, rol = ? WHERE id = ?",
                [$data['nombre'], $data['usuario'], $data['rol'], $id]
            );
        }
    }

    // Método para eliminar un usuario por su ID
    public function delete($id) {
        return $this->set_query("DELETE FROM usuarios WHERE id = ?", [$id]);
    }

    // Método para contar cuántos usuarios hay registrados
    public function contarUsuarios() {
        $result = $this->get_query("SELECT COUNT(*) as total FROM usuarios");
        return $result[0]['total'] ?? 0;
    }
    
}
