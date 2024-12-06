<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controladores\CentrosControlador;

$controlador = new CentrosControlador();

// Si no se pasa ninguna acción, mostrar el listado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['accion'])) {
    $controlador->index();
    exit();
}

// Manejar la acción de crear un nuevo centro
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'crear') {
    require __DIR__ . '/../app/vistas/centros/crear_centro.php'; // Cargar el formulario de creación
    exit();
}

// Manejar la acción de crear un nuevo centro
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'editar') {
    require __DIR__ . '/../app/vistas/centros/editar_centro.php';
    exit();
}

//si se pasa acción crear, editar, actualizar o eliminar x Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'crear') {
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        if ($nombre && $direccion && $telefono) {
            $controlador->crearCentro($nombre, $direccion, $telefono);
            header('Location: index_centros.php');
            exit();
        } else {
            echo "Faltan datos para crear el centro.";
        }
    }

    if ($accion === 'editar') {
        if ($accion === 'editar') {
            $id = $_POST['id'];
            if ($id) {
                $centro = $controlador->obtenerCentroPorId($id);
                require __DIR__ . '/../app/vistas/centros/editar_centro.php';
            } else {
                echo "ID no válido.";
            }
            exit();
        }
    }

    if ($accion === 'actualizar') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        if ($id && $nombre && $direccion && $telefono) {
            $controlador->editarCentro($id, $nombre, $direccion, $telefono);
            header('Location: index_centros.php');
        } else {
            echo "Datos incompletos para actualizar.";
        }
        exit();
    }

    if ($accion === 'eliminar') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $controlador->eliminarCentro($id);
            header('Location: index_centros.php');
        } else {
            echo "ID no válido para eliminar.";
        }
        exit();
    }
}

echo "Acción no reconocida.";
