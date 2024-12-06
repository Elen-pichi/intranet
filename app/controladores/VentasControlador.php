<?php

namespace App\Controladores;

use App\Config\Conexion;
use App\Modelos\VentasModelo;
use App\Modelos\ServiciosModelo;
use App\Modelos\TrabajadoresModelo;
use App\Modelos\CentrosModelo;

class VentasControlador
{
    private $ventaModelo;
    private $servicioModelo;
    private $trabajadorModelo;
    private $centroModelo;

    public function __construct()
    {
        $this->ventaModelo = new VentasModelo(Conexion::obtenerConexion());
        $this->servicioModelo = new ServiciosModelo(Conexion::obtenerConexion());
        $this->trabajadorModelo = new TrabajadoresModelo(Conexion::obtenerConexion());
        $this->centroModelo = new CentrosModelo(Conexion::obtenerConexion());
    }

    public function index()
    {
        $ventas = $this->ventaModelo->obtenerVentas(); // Todas las ventas con sus totales
        require_once __DIR__ . '/../vistas/ventas/mostrar_ventas.php';
    }

    public function crearVista()
    {

        $email = $_SESSION['email'];

        // Obtener trabajador y centro relacionados con el usuario
        $trabajador = $this->trabajadorModelo->obtenerTrabajadorPorEmail($email);
        $centro = $trabajador ? $this->centroModelo->obtenerCentroPorId($trabajador['id_centro']) : null;

        $centros = $this->centroModelo->mostrarCentros(); // Centros disponibles
        $trabajadores = $this->trabajadorModelo->mostrarTrabajadores(); // Trabajadores disponibles
        $servicios = $this->servicioModelo->mostrarServicios(); // Lista de servicios disponibles
        $numero = $this->ventaModelo->obtenerUltimoNumeroVenta(); // Obtener número de venta

        require_once __DIR__ . '/../vistas/ventas/crear_venta.php';
    }


    public function crearVenta($datos)
    {
        try {

            error_log("Datos recibidos: " . json_encode($datos));


            // Calcular el importe total
            $importeTotal = 0;

            foreach ($datos['servicios'] as $servicio) {
                // Validar datos de cada servicio
                if (empty($servicio['id_servicio']) || empty($servicio['cantidad']) || empty($servicio['precio_unitario'])) {
                    throw new \Exception("Faltan datos en el servicio: " . json_encode($servicio));
                }

                // Calcular subtotal
                $servicio['subtotal'] = $servicio['cantidad'] * $servicio['precio_unitario'];
                $importeTotal += $servicio['subtotal'];

                // Log detallado de cada servicio procesado
                error_log("Servicio procesado: " . json_encode($servicio));
            }

            $datos['importe_total'] = $importeTotal;
            // Obtener el último número de venta y calcular el siguiente
            $datos['numero'] = $this->ventaModelo->obtenerUltimoNumeroVenta();

            // Log del importe total calculado
            error_log("Importe total calculado para la venta: {$importeTotal}");

            // Crear la venta en la base de datos
            $ventaId = $this->ventaModelo->crearVenta([
                'id_trabajador' => $datos['id_trabajador'],
                'id_centro' => $datos['id_centro'],
                'numero' => $datos['numero'],
                'fecha' => $datos['fecha'],
                'tipo_transaccion' => $datos['tipo_transaccion'],
                'importe_total' => $importeTotal
            ]);

            if ($ventaId) {
                // Insertar servicios relacionados con la venta
                $this->ventaModelo->insertarServiciosVenta($ventaId, $datos['servicios']);
                header('Location: index_ventas.php?accion=index');
            } else {
                throw new \Exception("Error al registrar la venta en la base de datos.");
            }
        } catch (\Exception $e) {
            // Registrar el error y mostrar un mensaje claro
            error_log("Error en crearVenta: " . $e->getMessage());
            echo "<p style='color:red;'>Ocurrió un error al registrar la venta: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }

    public function editarVista($idVenta)
    {
        $venta = $this->ventaModelo->obtenerVentaPorId($idVenta); // Obtener datos de la venta
        $serviciosVenta = $this->ventaModelo->obtenerServiciosPorVenta($idVenta); // Obtener servicios asociados
        $centros = $this->centroModelo->mostrarCentros();
        $trabajadores = $this->trabajadorModelo->mostrarTrabajadores();
        $servicios = $this->servicioModelo->mostrarServicios(); // Todos los servicios disponibles

        require_once __DIR__ . '/../vistas/ventas/editar_venta.php';
    }

    public function editarVenta($datos)
    {
        try {
    
            $importeTotal = 0;
            foreach ($datos['servicios'] as &$servicio) {
                $servicio['subtotal'] = $servicio['cantidad'] * $servicio['precio_unitario'];
                $importeTotal += $servicio['subtotal'];
            }

            // Actualizar la venta
            $resultado = $this->ventaModelo->actualizarVenta([
                'id' => $datos['id'],
                'id_trabajador' => $datos['id_trabajador'],
                'id_centro' => $datos['id_centro'],
                'numero' => $datos['numero'],
                'fecha' => $datos['fecha'],
                'tipo_transaccion' => $datos['tipo_transaccion'],
                'importe_total' => $importeTotal
            ]);

            if ($resultado) {
                // Actualizar servicios asociados
                $this->ventaModelo->actualizarServiciosVenta($datos['id'], $datos['servicios']);
                header('Location: index_ventas.php?accion=index');
            } else {
                echo "Error al actualizar la venta.";
            }
        } catch (\Exception $e) {
            error_log("Error al actualizar la venta: " . $e->getMessage());
            echo "Ocurrió un error al actualizar la venta.";
        }
    }

    public function eliminarVenta($idVenta)
    {
        try {
            $resultado = $this->ventaModelo->eliminarVenta($idVenta);
            if ($resultado) {
                header('Location: index_ventas.php?accion=index');
            } else {
                echo "Error al eliminar la venta.";
            }
        } catch (\Exception $e) {
            error_log("Error al eliminar la venta: " . $e->getMessage());
            echo "Ocurrió un error al eliminar la venta.";
        }
    }

    public function detalleVista($idVenta)
    {
        $venta = $this->ventaModelo->obtenerVentaPorId($idVenta);
        $servicios = $this->ventaModelo->obtenerServiciosPorVenta($idVenta);

        if ($venta) {
            require_once __DIR__ . '/../vistas/ventas/detalle_venta.php';
        } else {
            echo "Venta no encontrada.";
        }
    }
}
