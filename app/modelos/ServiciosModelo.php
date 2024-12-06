<?php

namespace App\Modelos;

class ServiciosModelo
{
    private $db;

    public function __construct($dbConexion)
    {
        $this->db = $dbConexion;
    }

    //crear un nuevo servicio
    public function crearServicio($nombre, $duracion, $precio, $descripcion)
    {

        try {
            $sql = "INSERT INTO servicios (nombre, duracion, precio, descripcion) VALUES (:nombre, :duracion, :precio, :descripcion)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':duracion', $duracion);
            $stm->bindParam(':precio', $precio);
            $stm->bindParam(':descripcion', $descripcion);
            $resultado = $stm->execute();
            if (!$resultado) {
                // Imprimir errores del PDOStatement
                error_log("Error PDOStatement: " . implode(", ", $stm->errorInfo()));
            }
            return $resultado;
        } catch (\PDOException $e) {
            error_log("Error al crear el servicio: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //mostrar los servicios
    public function mostrarServicios()
    {
        try {
            $sql = "SELECT * FROM servicios";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (\PDOException $e) {
            error_log("Error al mostrar el servicio: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //obtener un servicio según el id
    public function obtenerServicioPorId($id)
    {
        try {
            $sql = "SELECT * FROM servicios WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->execute();
            return $stm->fetch();
        } catch (\PDOException $e) {
            error_log("Error al obtener el servicio por ID: " . $e->getMessage());
            return false;
        }
    }

    //actualizar un servicio
    public function editarServicio($id, $nombre, $duracion, $precio, $descripcion)
    {
        try {
            $sql = "UPDATE servicios SET nombre=:nombre, duracion=:duracion, precio=:precio, descripcion=:descripcion WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':duracion', $duracion);
            $stm->bindParam(':precio', $precio);
            $stm->bindParam(':descripcion', $descripcion);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al editar el servicio: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    public function eliminarServicio($id)
    {
        try {
            $sql = "DELETE FROM servicios WHERE id=:id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al eliminar el servicio: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }
}
