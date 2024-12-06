<?php

namespace App\Modelos;

use App\Config\Conexion;

class VentasModelo
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::obtenerConexion();
    }

    /**
     * Obtener todas las ventas con sus totales
     */
    public function obtenerVentas()
    {
        try {
            $sql = "
                SELECT 
                    v.id, 
                    v.numero, 
                    v.fecha, 
                    v.tipo_transaccion, 
                    v.importe_total, 
                    t.nombre AS trabajador_nombre, 
                    t.apellidos AS trabajador_apellidos, 
                    c.nombre AS centro_nombre
                FROM ventas v
                INNER JOIN trabajadores t ON v.id_trabajador = t.id
                INNER JOIN centros c ON v.id_centro = c.id
                ORDER BY v.numero
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener las ventas: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Crear una nueva venta
     */
    public function obtenerUltimoNumeroVenta()
    {
        try {
            $sql = "SELECT MAX(numero) AS max_numero FROM ventas";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            // Retornar el siguiente número (incrementar en 1)
            return $resultado['max_numero'] ? $resultado['max_numero'] + 1 : 1;
        } catch (\PDOException $e) {
            error_log("Error al obtener el último número de venta: " . $e->getMessage());
            return 1; // Retornar 1 si no hay ventas registradas
        }
    }
    
    public function crearVenta($datos)
    {
        try {
            $this->db->beginTransaction();
    
            $sql = "
                INSERT INTO ventas (id_trabajador, id_centro, numero, fecha, tipo_transaccion, importe_total)
                VALUES (:id_trabajador, :id_centro, :numero,:fecha, :tipo_transaccion, :importe_total)
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_trabajador' => $datos['id_trabajador'],
                ':id_centro' => $datos['id_centro'],
                ':numero' => $datos['numero'],
                ':fecha' => $datos['fecha'],
                ':tipo_transaccion' => $datos['tipo_transaccion'],
                ':importe_total' => $datos['importe_total']
            ]);
    
            $ventaId = $this->db->lastInsertId();
    
            // Confirmar la transacción
            $this->db->commit();
            return $ventaId;
        } catch (\PDOException $e) {
            // Revertir la transacción en caso de error
            $this->db->rollBack();
            error_log("Error al crear la venta: " . $e->getMessage());
            return false;
        }
    }
    
    public function insertarServiciosVenta($ventaId, $servicios)
    {
        try {
            foreach ($servicios as $servicio) {
                if (!isset($servicio['subtotal'])) {
                    throw new \Exception("El subtotal no está calculado para el servicio: " . json_encode($servicio));
                }
                $sql = "
                    INSERT INTO ventas_servicios (id_venta, id_servicio, cantidad, precio_unitario, subtotal)
                    VALUES (:id_venta, :id_servicio, :cantidad, :precio_unitario, :subtotal)
                ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':id_venta' => $ventaId,
                    ':id_servicio' => $servicio['id_servicio'],
                    ':cantidad' => $servicio['cantidad'],
                    ':precio_unitario' => $servicio['precio_unitario'],
                    ':subtotal' => $servicio['subtotal']
                ]);
            }
        } catch (\PDOException $e) {
            error_log("Error al insertar servicios de la venta: " . $e->getMessage());
            throw $e; // Escalar el error al controlador
        }
    }
    

    /**
     * Obtener una venta específica por su ID
     */
    public function obtenerVentaPorId($idVenta)
    {
        try {
            $sql = "
                SELECT 
                    v.id,
                    v.numero,
                    v.fecha,
                    v.tipo_transaccion,
                    v.importe_total,
                    v.id_trabajador,
                    t.nombre AS trabajador_nombre,
                    t.apellidos AS trabajador_apellidos,
                    v.id_centro,
                    c.nombre AS centro_nombre
                FROM ventas v
                INNER JOIN trabajadores t ON v.id_trabajador = t.id
                INNER JOIN centros c ON v.id_centro = c.id
                WHERE v.id = :id
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $idVenta, \PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener la venta por ID: " . $e->getMessage());
            return false;
        }
    }
    

    /**
     * Obtener servicios asociados a una venta específica
     */
    public function obtenerServiciosPorVenta($idVenta)
    {
        var_dump($idVenta);
        try {
            $sql = "
                SELECT 
                    vs.id_servicio AS servicio,
                    s.nombre,
                    s.duracion, 
                    vs.cantidad, 
                    vs.precio_unitario AS precio,
                    vs.subtotal
                FROM ventas_servicios vs
                INNER JOIN servicios s ON vs.id_servicio = s.id
                WHERE vs.id_venta = :id
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $idVenta]);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error al obtener los servicios de la venta: " . $e->getMessage());
            return [];
        }
    }

    public function actualizarVenta($datos)
    {
        try {
            $sql = "
                UPDATE ventas 
                SET id_trabajador = :id_trabajador, 
                    id_centro = :id_centro,
                    numero = :numero, 
                    fecha = :fecha, 
                    tipo_transaccion = :tipo_transaccion, 
                    importe_total = :importe_total
                WHERE id = :id
            ";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id' => $datos['id'],
                ':id_trabajador' => $datos['id_trabajador'],
                ':id_centro' => $datos['id_centro'],
                ':numero' => $datos['numero'],
                ':fecha' => $datos['fecha'],
                ':tipo_transaccion' => $datos['tipo_transaccion'],
                ':importe_total' => $datos['importe_total']
            ]);
        } catch (\PDOException $e) {
            error_log("Error al actualizar la venta: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarServiciosVenta($idVenta, $servicios)
    {
        try {
            // Eliminar servicios existentes para esta venta
            $sqlDelete = "DELETE FROM ventas_servicios WHERE id_venta = :id_venta";
            $stmtDelete = $this->db->prepare($sqlDelete);
            $stmtDelete->execute([':id_venta' => $idVenta]);

            // Insertar los nuevos servicios
            return $this->insertarServiciosVenta($idVenta, $servicios);
        } catch (\PDOException $e) {
            error_log("Error al actualizar servicios de la venta: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarVenta($idVenta)
    {
        try {
            // Eliminar primero los servicios asociados
            $sqlDeleteServicios = "DELETE FROM ventas_servicios WHERE id_venta = :id_venta";
            $stmtServicios = $this->db->prepare($sqlDeleteServicios);
            $stmtServicios->execute([':id_venta' => $idVenta]);

            // Luego eliminar la venta
            $sqlDeleteVenta = "DELETE FROM ventas WHERE id = :id_venta";
            $stmtVenta = $this->db->prepare($sqlDeleteVenta);
            return $stmtVenta->execute([':id_venta' => $idVenta]);
        } catch (\PDOException $e) {
            error_log("Error al eliminar la venta: " . $e->getMessage());
            return false;
        }
    }
}
