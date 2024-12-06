<?php

namespace App\Modelos;

class CentrosModelo
{
    private $db;

    public function __construct($dbConexion)
    {
        $this->db = $dbConexion;
    }

    //crear un nuevo centro
    public function crearCentro($nombre, $direccion, $telefono)
    {

        try {
            $sql = "INSERT INTO centros (nombre, direccion, telefono) VALUES (:nombre, :direccion, :telefono)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':direccion', $direccion);
            $stm->bindParam(':telefono', $telefono);
            $resultado = $stm->execute();
            if (!$resultado) {
                // Imprimir errores del PDOStatement
                error_log("Error PDOStatement: " . implode(", ", $stm->errorInfo()));
            }
            return $resultado;
        } catch (\PDOException $e) {
            error_log("Error al crear el centro: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //mostrar los centros
    public function mostrarCentros()
    {
        try {
            $sql = "SELECT * FROM centros";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (\PDOException $e) {
            error_log("Error al mostrar el centro: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //obtener un centro según el id
    public function obtenerCentroPorId($id)
    {
        try {
            $sql = "SELECT * FROM centros WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id, \PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch();
        } catch (\PDOException $e) {
            error_log("Error al obtener el centro por ID: " . $e->getMessage());
            return false;
        }
    }

    //actualizar un centro
    public function editarCentro($id, $nombre, $direccion, $telefono)
    {
        try {
            $sql = "UPDATE centros SET nombre=:nombre, direccion=:direccion, telefono=:telefono WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':direccion', $direccion);
            $stm->bindParam(':telefono', $telefono);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al editar el centro: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    public function eliminarCentro($id)
    {
        try {
            $sql = "DELETE FROM centros WHERE id=:id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al eliminar el centro: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }
}
