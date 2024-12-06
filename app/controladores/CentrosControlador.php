<?php

namespace App\Controladores;

use App\Modelos\CentrosModelo;
use App\Config\Conexion;

class CentrosControlador
{
    private $centroModelo;

    public function __construct()
    {
        // Crear un nuevo objeto de CentrosModelo pasando la conexión
        $this->centroModelo = new CentrosModelo(Conexion::obtenerConexion());
    }

    // Función para listar todos los centros
    public function index()
    {
        try {
            $centros = $this->centroModelo->mostrarCentros();
            require_once __DIR__ . '/../vistas/centros/mostrar_centros.php';
        } catch (\Exception $e) {
            error_log("Error al listar centros: " . $e->getMessage());
            echo "Hubo un error al cargar la lista de centros.";
        }
    }

    // Función para obtener un centro por su ID
    public function obtenerCentroPorId($id)
    {
        try {
            return $this->centroModelo->obtenerCentroPorId($id);
        } catch (\Exception $e) {
            error_log("Error al obtener el centro: " . $e->getMessage());
            echo "Hubo un error al obtener el centro.";
            return null;
        }
    }

    // Función para actualizar un centro
    public function editarCentro($id, $nombre, $direccion, $telefono)
    {
        if (empty($id) || empty($nombre) || empty($direccion) || empty($telefono)) {
            echo "Todos los campos son obligatorios para actualizar el centro.";
            return false;
        }

        try {
            $resultado = $this->centroModelo->editarCentro($id, $nombre, $direccion, $telefono);
            if ($resultado) {
                return true;
            } else {
                echo "Error al actualizar el centro.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al actualizar el centro: " . $e->getMessage());
            echo "Hubo un error al actualizar el centro.";
            return false;
        }
    }

    // Función para crear un centro
    public function crearCentro($nombre, $direccion, $telefono)
    {
        if (empty($nombre) || empty($direccion) || empty($telefono)) {
            echo "Todos los campos son obligatorios para crear un centro.";
            return false;
        }

        try {
            $resultado = $this->centroModelo->crearCentro($nombre, $direccion, $telefono);
            if ($resultado) {
                echo "Centro creado.";
                return true;
            } else {
                echo "Error al crear el centro.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al crear el centro: " . $e->getMessage());
            echo "Hubo un error al crear el centro.";
            return false;
        }
    }

    // Función para eliminar un centro
    public function eliminarCentro($id)
    {
        try {
            $resultado = $this->centroModelo->eliminarCentro($id);
            if ($resultado) {
                return true;
            } else {
                echo "Error al eliminar el centro.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al eliminar el centro: " . $e->getMessage());
            echo "Hubo un error al eliminar el centro.";
            return false;
        }
    }
}
