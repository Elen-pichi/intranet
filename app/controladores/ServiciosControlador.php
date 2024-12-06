<?php

namespace App\Controladores;

use App\Modelos\ServiciosModelo;
use App\Config\Conexion;

class ServiciosControlador
{
    private $servicioModelo;

    public function __construct()
    {
        // Crear un nuevo objeto de CentrosModelo pasando la conexión
        $this->servicioModelo = new ServiciosModelo(Conexion::obtenerConexion());
    }

    // Función para listar todos los servicios
    public function index()
    {
        try {
            $servicios = $this->servicioModelo->mostrarServicios();
            require_once __DIR__ . '/../vistas/servicios/mostrar_servicios.php';
        } catch (\Exception $e) {
            error_log("Error al listar los servicios: " . $e->getMessage());
            echo "Hubo un error al cargar la lista de servicios.";
        }
    }

    // Función para crear un servicio
    public function crearServicio($nombre, $duracion, $precio, $descripcion)
    {
        if (empty($nombre) || empty($duracion) || empty($precio)) {
            echo "Normbre, duración y precio son obligatorios para crear un centro.";
            return false;
        }

        try {
            $resultado = $this->servicioModelo->crearServicio($nombre, $duracion, $precio, $descripcion);
            if ($resultado) {
                echo "Servicio creado.";
                return true;
            } else {
                echo "Error al crear el servicio.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al crear el servicio: " . $e->getMessage());
            echo "Hubo un error al crear el servicio.";
            return false;
        }
    }

    // Función para obtener un servicio por su ID
    public function obtenerServicioPorId($id)
    {
        try {
            return $this->servicioModelo->obtenerServicioPorId($id);
        } catch (\Exception $e) {
            error_log("Error al obtener el centro: " . $e->getMessage());
            echo "Hubo un error al obtener el centro.";
            return null;
        }
    }

    // Función para actualizar un servicio
    public function editarServicio($id, $nombre, $duracion, $precio, $descripcion)
    {
        if (empty($id) || empty($nombre) || empty($duracion) || empty($precio)) {
            echo "Los campo nombre, duración y precio son obligatorios para actualizar el servicio.";
            return false;
        }

        try {
            $resultado = $this->servicioModelo->editarServicio($id, $nombre, $duracion, $precio, $descripcion);
            if ($resultado) {
                return true;
            } else {
                echo "Error al actualizar el servicio.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al actualizar el servicio: " . $e->getMessage());
            echo "Hubo un error al actualizar el servicio.";
            return false;
        }
    }

    // Función para eliminar un centro
    public function eliminarServicio($id)
    {
        try {
            $resultado = $this->servicioModelo->eliminarServicio($id);
            if ($resultado) {
                return true;
            } else {
                echo "Error al eliminar el servicio.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al eliminar el servicio: " . $e->getMessage());
            echo "Hubo un error al eliminar el servicio.";
            return false;
        }
    }
}
