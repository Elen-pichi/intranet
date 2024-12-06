<?php

namespace App\Controladores;

use App\Modelos\UsuariosModelo;
use App\Config\Conexion;

class UsuariosControlador {
    private $usuarioModelo;

    public function __construct() {
        try {
            $this->usuarioModelo = new UsuariosModelo(Conexion::obtenerConexion());
        } catch (\Exception $e) {
            error_log("Error al inicializar el modelo: " . $e->getMessage());
            die("Error al conectar con la base de datos.");
        }
    }

    public function index() {
        try {
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            require_once __DIR__ . '/../vistas/usuarios/mostrar_usuarios.php';
        } catch (\Exception $e) {
            error_log("Error al obtener usuarios: " . $e->getMessage());
            echo "Error al cargar la lista de usuarios.";
        }
    }

    public function crearVista() {
        try {
            require_once __DIR__ . '/../vistas/usuarios/crear_usuario.php';
        } catch (\Exception $e) {
            error_log("Error al cargar la vista de creación: " . $e->getMessage());
            echo "Error al cargar la página de creación de usuario.";
        }
    }

    public function crearUsuario($email, $password, $rol) {
        try {
            $this->usuarioModelo->crearUsuario($email, $password, $rol);
        } catch (\Exception $e) {
            error_log("Error al crear usuario: " . $e->getMessage());
            echo "Error al crear el usuario.";
        }
    }

    public function editarVista($email) {
        try {
            $usuario = $this->usuarioModelo->obtenerUsuarioPorEmail($email);
            if (!$usuario) {
                throw new \Exception("Usuario no encontrado.");
            }
            require_once __DIR__ . '/../vistas/usuarios/editar_usuario.php';
        } catch (\Exception $e) {
            error_log("Error al cargar la vista de edición: " . $e->getMessage());
            echo "Error al cargar la página de edición del usuario.";
        }
    }

    public function editarUsuario($email, $password, $rol, $activo) {
        try {
            $this->usuarioModelo->editarUsuario($email, $password, $rol, $activo);
        } catch (\Exception $e) {
            error_log("Error al editar usuario: " . $e->getMessage());
            echo "Error al actualizar el usuario.";
        }
    }

    public function eliminarUsuario($email) {
        try {
            $this->usuarioModelo->eliminarUsuario($email);
        } catch (\Exception $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            echo "Error al eliminar el usuario.";
        }
    }
}

