<?php
abstract class Model {
    private $host = 'localhost:3306';
    private $user = 'root';
    private $password = '';
    private $db_name = 'textil_export';
    protected $conn;

    // Crear conexión
    protected function open_db() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name;charset=utf8", $this->user, $this->password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Cerrar conexión
    protected function close_db() {
        $this->conn = null;
    }

    protected function get_query($query, $params = array()) {
        try {
            $rows = [];
            $this->open_db();
            $stm = $this->conn->prepare($query);
            $stm->execute($params);
            while ($rows[] = $stm->fetch(PDO::FETCH_ASSOC));
            $this->close_db();
            array_pop($rows); // quitar último elemento (false)
            return $rows;
        } catch (Exception $e) {
            $this->close_db();
            return [];
        }
    }

    protected function set_query($query, $params = array()) {
        try {
            $this->open_db();
            $stm = $this->conn->prepare($query);
            $stm->execute($params);
            $affectedRows = $stm->rowCount();
            $this->close_db();
            return $affectedRows;
        } catch (Exception $e) {
            $this->close_db();
            return 0;
        }
    }

    // NUEVO: insert_query que devuelve el ID insertado
    protected function insert_query($query, $params = array()) {
        try {
            $this->open_db();
            $stm = $this->conn->prepare($query);
            $stm->execute($params);
            $id = $this->conn->lastInsertId();
            $this->close_db();
            return $id;
        } catch (Exception $e) {
            $this->close_db();
            return null;
        }
    }
}
