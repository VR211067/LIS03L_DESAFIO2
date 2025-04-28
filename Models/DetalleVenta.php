<?php
require_once 'Model.php';

class DetalleVenta extends Model {
    public function create($data) {
        return $this->set_query(
            "INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)",
            [
                $data['venta_id'], $data['producto_id'],
                $data['cantidad'], $data['precio_unitario']
            ]
        );
    }
}
