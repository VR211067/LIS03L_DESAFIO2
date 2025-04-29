<?php
require_once 'Model.php';

class Cliente extends Model {

    // Método para obtener un cliente por su correo electrónico
    public function getByEmail($email) {
        return $this->get_query("SELECT * FROM clientes WHERE email = ?", [$email]);
    }
    
    // Método para obtener un cliente por su ID
    public function getById($id) {
        return $this->get_query("SELECT * FROM clientes WHERE id = ?", [$id]);
    }
    
    // Método para crear un nuevo cliente
    public function create($data) {
        
        // Se encripta la contraseña utilizando el algoritmo BCRYPT antes de guardarla
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->set_query(
            "INSERT INTO clientes (nombre, email, password) VALUES (?, ?, ?)",
            [$data['nombre'], $data['email'], $data['password']]
        );
    }

    // Método para actualizar los datos de un cliente por su ID
    public function update($id, $data) {
        return $this->set_query(
            "UPDATE clientes SET nombre = ?, email = ?, activo = ? WHERE id = ?",
            [$data['nombre'], $data['email'], $data['activo'], $id]
        );
    }

    // Método para obtener todos los clientes de la base de datos
    public function getAll() {
        return $this->get_query("SELECT * FROM clientes");
    }

    // Método para contar cuántos clientes hay en total
    public function contarClientes() {
        $result = $this->get_query("SELECT COUNT(*) as total FROM clientes");
        return $result[0]['total'] ?? 0;
    }
    
    // Método para eliminar un cliente por su ID
    public function delete($id) {
        return $this->set_query("DELETE FROM clientes WHERE id = ?", [$id]);
    }
    
}
