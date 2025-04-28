<?php
require_once 'Model.php';

class Usuario extends Model {

    public function getByUsuario($usuario) {
        return $this->get_query("SELECT * FROM usuarios WHERE usuario = ?", [$usuario]);
    }

    public function getAll() {
        return $this->get_query("SELECT * FROM usuarios");
    }

    public function getById($id) {
        return $this->get_query("SELECT * FROM usuarios WHERE id = ?", [$id]);
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->set_query(
            "INSERT INTO usuarios (nombre, usuario, password, rol) VALUES (?, ?, ?, ?)",
            [$data['nombre'], $data['usuario'], $data['password'], $data['rol']]
        );
    }

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

    public function delete($id) {
        return $this->set_query("DELETE FROM usuarios WHERE id = ?", [$id]);
    }
    public function contarUsuarios() {
        $result = $this->get_query("SELECT COUNT(*) as total FROM usuarios");
        return $result[0]['total'] ?? 0;
    }
    
}
