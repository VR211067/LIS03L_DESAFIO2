<?php
require_once 'Model.php';

class Venta extends Model {

    public function create($data) {
        return $this->insert_query("INSERT INTO ventas (cliente_id, total) VALUES (?, ?)", [
            $data['cliente_id'], $data['total']
        ]);
    }

    public function guardarComprobante($venta_id, $pdf) {
        return $this->set_query("UPDATE ventas SET comprobante_pdf = ? WHERE id = ?", [
            $pdf, $venta_id
        ]);
    }

    public function getAll() {
        return $this->get_query("SELECT v.*, c.nombre AS cliente FROM ventas v JOIN clientes c ON v.cliente_id = c.id ORDER BY fecha DESC");
    }
    public function getTotalVentas() {
        $result = $this->get_query("SELECT SUM(total) as total FROM ventas");
        return $result[0]['total'] ?? 0;
    }
    
}
