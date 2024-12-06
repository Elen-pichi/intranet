<?php

namespace App\Modelos;

class TrabajadoresModelo
{
    private $db;

    public function __construct($dbConexion)
    {
        $this->db = $dbConexion;
    }

/* OBTENCIÓN DE LOS CENTROS -- VERIFICAR EXISTENCIA -- OBTENER NOMBRE SEGUN ID_CENTRO */

    //función para la obtención de los centros para poder usar el atributo nombre en vez id
    public function obtenerCentros()
    {
        try {
            $sql = "SELECT id, nombre FROM centros";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(); // Devuelve todos los centros como un array asociativo
        } catch (\PDOException $e) {
            error_log("Error al obtener los centros: " . $e->getMessage());
            return [];
        }
    }

    //verificar que el centro existe
    public function centroExiste($id_centro)
    {
        try {
            $sql = "SELECT COUNT(*) FROM centros WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id_centro);
            $stm->execute();
            return $stm->fetchColumn() > 0;
        } catch (\PDOException $e) {
            error_log("Error al verificar el centro: " . $e->getMessage());
            return false;
        }
    }

    //obtener el nombre del centro según su id en la base
    public function obtenerNombreCentroPorId($id_centro)
    {
        try {
            $sql = "SELECT nombre FROM centros WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id_centro, \PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchColumn(); // Devuelve el nombre del centro o false si no existe
        } catch (\PDOException $e) {
            error_log("Error al obtener el nombre del centro: " . $e->getMessage());
            return null;
        }
    }

/* FINAL DE LOS CENTROS - INICIO CONSULTAS TRABAJADORES */

    //crear un nuevo trabajador
    public function crearTrabajador($nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro)
    {

        try {
            $sql = "INSERT INTO trabajadores (nombre, apellidos, e_mail, telefono, salario, id_centro) VALUES (:nombre, :apellidos, :e_mail, :telefono, :salario, :id_centro)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':apellidos', $apellidos);
            $stm->bindParam(':e_mail', $e_mail);
            $stm->bindParam(':telefono', $telefono);
            $stm->bindParam(':salario', $salario);
            $stm->bindParam(':id_centro', $id_centro);
            $resultado = $stm->execute();
            return $resultado;
        } catch (\PDOException $e) {
            error_log("Error al añadir un trabajador: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //mostrar los trabajadores
    public function mostrarTrabajadores()
    {
        try {
            $sql = "SELECT t.*, c.nombre AS centro_nombre FROM trabajadores t
            LEFT JOIN centros c ON t.id_centro = c.id";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetchAll();
        } catch (\PDOException $e) {
            error_log("Error al mostrar el listado de trabajadores: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //obtener un trabajador según el id
    public function obtenerTrabajadorPorId($id)
    {
        try {
            $sql = "SELECT * FROM trabajadores WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->execute();
            return $stm->fetch();
        } catch (\PDOException $e) {
            error_log("Error al obtener al trabajador por ID: " . $e->getMessage());
            return false;
        }
    }

    //actualizar un trabajador
    public function editarTrabajador($id, $nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro)
    {
        try {
            $sql = "UPDATE trabajadores SET nombre = :nombre, apellidos = :apellidos, e_mail = :e_mail, telefono = :telefono, salario = :salario, id_centro = :id_centro WHERE id = :id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            $stm->bindParam(':nombre', $nombre);
            $stm->bindParam(':apellidos', $apellidos);
            $stm->bindParam(':e_mail', $e_mail);
            $stm->bindParam(':telefono', $telefono);
            $stm->bindParam(':salario', $salario);
            $stm->bindParam(':id_centro', $id_centro);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al editar al trabajador: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    public function eliminarTrabajador($id)
    {
        try {
            $sql = "DELETE FROM trabajadores WHERE id=:id";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':id', $id);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al eliminar al trabajador: " . $e->getLine() . " " . $e->getMessage());
            return false;
        }
    }

    //función para verificar si un e_mail exite en la base de datos
    public function existeEmail($e_mail)
    {
        try {
            $sql = "SELECT COUNT(*) FROM trabajadores WHERE e_mail = :e_mail";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':e_mail', $e_mail);
            $stm->execute();
            $count = $stm->fetchColumn();
            return $count > 0; // devuelve true si exixte, false si no
        } catch (\PDOException $e) {
            error_log("Error al verificar el email: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTrabajadorPorEmail($email)
{
    try {
        $sql = "
            SELECT t.*
            FROM trabajadores t
            INNER JOIN usuarios u ON t.e_mail = u.email
            WHERE u.email = :email
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        error_log("Error al obtener el trabajador por email: " . $e->getMessage());
        return null;
    }
}

}
