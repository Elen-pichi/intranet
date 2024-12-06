<?php

namespace App\Modelos;

class UsuariosModelo
{
    private $db;

    public function __construct($dbConexion)
    {
        $this->db = $dbConexion;
    }

    public function obtenerUsuarios() {
        try {
            $sql = "SELECT u.email, u.rol, u.activo, t.nombre AS nombre, t.apellidos AS apellidos
                    FROM usuarios u 
                    INNER JOIN trabajadores t ON u.email = t.e_mail";    
            $stm = $this->db->prepare($sql);
            $resultado = $stm->execute();    
            return $stm->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Error en obtenerUsuarios: " . $e->getMessage());
            return [];
        }
    }
    
    public function crearUsuario($email, $password, $rol)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        try {
            $sql = "INSERT INTO usuarios (email, password, rol, activo) VALUES (:email, :password, :rol, 1)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':password', $hashedPassword);
            $stm->bindParam(':rol', $rol);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al crear usuario: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerUsuarioPorEmail($email)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':email', $email);
            $stm->execute();
            return $stm->fetch();
        } catch (\PDOException $e) {
            error_log("Error al obtener usuario: " . $e->getMessage());
            return false;
        }
    }

    public function editarUsuario($email, $password, $rol, $activo)
    {
        try {
            if ($password) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $sql = "UPDATE usuarios SET password = :password, rol = :rol, activo = :activo WHERE email = :email";
                $stm = $this->db->prepare($sql);
                $stm->bindParam(':password', $hashedPassword);
            } else {
                $sql = "UPDATE usuarios SET rol = :rol, activo = :activo WHERE email = :email";
                $stm = $this->db->prepare($sql);
            }
            $stm->bindParam(':rol', $rol);
            $stm->bindParam(':activo', $activo, \PDO::PARAM_INT);
            $stm->bindParam(':email', $email);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al editar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarUsuario($email)
    {
        try {
            $sql = "DELETE FROM usuarios WHERE email = :email";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(':email', $email);
            return $stm->execute();
        } catch (\PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}
