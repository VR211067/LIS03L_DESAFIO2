<?php
require_once 'Model.php';

class Cliente extends Model {

    public function getByEmail($email) {
        return $this->get_query("SELECT * FROM clientes WHERE email = ?", [$email]);
    }

    public function getById($id) {
        return $this->get_query("SELECT * FROM clientes WHERE id = ?", [$id]);
    }

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->set_query(
            "INSERT INTO clientes (nombre, email, password) VALUES (?, ?, ?)",
            [$data['nombre'], $data['email'], $data['password']]
        );
    }

    public function update($id, $data) {
        return $this->set_query(
            "UPDATE clientes SET nombre = ?, email = ?, activo = ? WHERE id = ?",
            [$data['nombre'], $data['email'], $data['activo'], $id]
        );
    }

    public function getAll() {
        return $this->get_query("SELECT * FROM clientes");
    }
    public function contarClientes() {
        $result = $this->get_query("SELECT COUNT(*) as total FROM clientes");
        return $result[0]['total'] ?? 0;
    }
    public function delete($id) {
        return $this->set_query("DELETE FROM clientes WHERE id = ?", [$id]);
    }
    
}
