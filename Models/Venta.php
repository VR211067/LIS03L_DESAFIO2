<?php
require_once 'Model.php';

class Venta extends Model {

    // Método para crear una nueva venta
    public function create($data) {

        // Inserta una nueva fila en la tabla 'ventas' con el ID del cliente y el total de la venta
        
        return $this->insert_query("INSERT INTO ventas (cliente_id, total) VALUES (?, ?)", [
            $data['cliente_id'], $data['total']
        ]);
    }

     // Método para guardar un comprobante (PDF) de la venta
    public function guardarComprobante($venta_id, $pdf) {
        return $this->set_query("UPDATE ventas SET comprobante_pdf = ? WHERE id = ?", [
            $pdf, $venta_id
        ]);
    }

    // Método para obtener todas las ventas
    public function getAll() {
        return $this->get_query("SELECT v.*, c.nombre AS cliente FROM ventas v JOIN clientes c ON v.cliente_id = c.id ORDER BY fecha DESC");
    }

    // Método para calcular el total acumulado de todas las ventas
    public function getTotalVentas() {
        $result = $this->get_query("SELECT SUM(total) as total FROM ventas");
        return $result[0]['total'] ?? 0;
    }
    
}
