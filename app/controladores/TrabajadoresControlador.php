<?php

namespace App\Controladores;

use App\Modelos\TrabajadoresModelo;
use App\Config\Conexion;

class TrabajadoresControlador
{
    private $trabajadorModelo;


    public function __construct()
    {
        // Crear un nuevo objeto de trabajadores pasando la conexión
        $this->trabajadorModelo = new TrabajadoresModelo(Conexion::obtenerConexion());
    }

    // Función para listar todos los trabajadores
    public function index()
    {
        try {
            $trabajadores = $this->trabajadorModelo->mostrarTrabajadores();
            require_once __DIR__ . '/../vistas/trabajadores/mostrar_trabajadores.php';
        } catch (\Exception $e) {
            error_log("Error al listar los trabajadores: " . $e->getMessage());
            echo "Hubo un error al cargar la lista de trabajadores.";
        }
    }

    //función para la optención de los centros para poder usar el atributo nombre en vez id
    public function obtenerCentros()
    {
        try {
            return $this->trabajadorModelo->obtenerCentros();
        } catch (\Exception $e) {
            error_log("Error al obtener los centros: " . $e->getMessage());
            return [];
        }
    }
    //cargar la vista de crear trabajador con los centros disponibles
    public function crearVista()
    {
        try {
            $centros = $this->obtenerCentros();
            require_once __DIR__ . '/../vistas/trabajadores/crear_trabajador.php';
        } catch (\Exception $e) {
            error_log("Error al cargar la vista de creación: " . $e->getMessage());
            echo "Hubo un error al cargar la vista de creación.";
        }
    }

    //cargar la vista del trabajador según id y los centros existentes
    public function editarVista($id)
    {
        try {
            // Obtener los datos del trabajador por su ID
            $trabajador = $this->trabajadorModelo->obtenerTrabajadorPorId($id);
            if (!$trabajador) {
                echo "El trabajador no existe.";
                return;
            }
            // Obtener los centros disponibles
            $centros = $this->obtenerCentros();
            // Cargar la vista de edición con los datos
            require_once __DIR__ . '/../vistas/trabajadores/editar_trabajador.php';
        } catch (\Exception $e) {
            error_log("Error al cargar la vista de edición: " . $e->getMessage());
            echo "Hubo un error al cargar la vista de edición.";
        }
    }


    // Función para obtener un trabajador por su ID
    public function obtenerTrabajadorPorId($id)
    {
        try {
            $trabajador = $this->trabajadorModelo->obtenerTrabajadorPorId($id);
        } catch (\Exception $e) {
            error_log("Error al obtener el trabajador: " . $e->getMessage());
            echo "Hubo un error al obtener el trabajador.";
            return null;
        }
    }

    // Función para crear un trabajador
    public function crearTrabajador($nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro)
    {
        if (empty($nombre) || empty($apellidos) || empty($e_mail) || empty($id_centro)) {
            echo "Todos los campos son obligatorios para crear un trabajador.";
            return false;
        }
        if (!$this->trabajadorModelo->centroExiste($id_centro)) {
            echo "El centro seleccionado no es válido.";
            return false;
        }

        try {
            $resultado = $this->trabajadorModelo->crearTrabajador($nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro);
            if ($resultado) {
                echo "trabajador creado.";
                return true;
            } else {
                echo "Error al crear el trabajador.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al crear el trabajador: " . $e->getMessage());
            echo "Hubo un error al crear el trabajador.";
            return false;
        }
    }

    // Función para actualizar un trabajador
    public function editarTrabajador($id, $nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro)
    {
        if (empty($id) || empty($nombre) || empty($apellidos) || empty($e_mail) || empty($id_centro)) {
            echo "Todos los campos son obligatorios para actualizar el trabajador.";
            return false;
        }

        //verificar que el id_centro exite en la base
        if (!$this->trabajadorModelo->centroExiste($id_centro)) {
            echo "El centro seleccionado no es válido.";
            return false;
        }

        try {
            $resultado = $this->trabajadorModelo->editarTrabajador($id, $nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro);
            if ($resultado) {
                return true;
            } else {
                echo "Error al actualizar el trabajador.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al actualizar el trabajador: " . $e->getMessage());
            echo "Hubo un error al actualizar el trabajador.";
            return false;
        }
    }



    // Función para eliminar un trabajador
    public function eliminarTrabajador($id)
    {
        try {
            $resultado = $this->trabajadorModelo->eliminarTrabajador($id);
            if ($resultado) {
                return true;
            } else {
                echo "Error al eliminar el trabajador.";
                return false;
            }
        } catch (\Exception $e) {
            error_log("Error al eliminar el trabajador: " . $e->getMessage());
            echo "Hubo un error al eliminar el trabajador.";
            return false;
        }
    }

    //función para verificar si ya existe en la bbdd el e_mail que se quiere introducir
    public function verificarEmail()
    {
        if (isset($_POST['e_mail'])) {
            $e_mail = $_POST['e_mail'];

            try {
                $existe = $this->trabajadorModelo->existeEmail($e_mail);
                echo json_encode(['exists' => $existe]);
            } catch (\Exception $e) {
                error_log("Error al verificar el email: " . $e->getMessage());
                echo json_encode(['error' => 'Error al verificar el email.']);
            }
        } else {
            echo json_encode(['error' => 'No se recibió ningún correo electrónico.']);
        }
    }

    
}
