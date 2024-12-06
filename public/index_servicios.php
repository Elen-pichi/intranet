<?php
require __DIR__ . '/../vendor/autoload.php';


use App\Controladores\ServiciosControlador;

$controlador = new ServiciosControlador();

// Si no se pasa ninguna acción, mostrar el listado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['accion'])) {
    $controlador->index();
    exit();
}

// Manejar la acción de crear un nuevo servicio
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'crear') {
    require __DIR__ . '/../app/vistas/servicios/crear_servicio.php'; // Cargar el formulario de creación
    exit();
}

//si se pasa acción crear, editar, actualizar o eliminar x Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'crear') {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        if ($nombre && $duracion && $precio) {
            $controlador->crearServicio($nombre, $duracion, $precio, $descripcion);
            header('Location: index_servicios.php');
            exit();
        } else {
            echo "Faltan datos para crear el servicio.";
        }
    }

    if ($accion === 'editar') {
        if ($accion === 'editar') {
            $id = $_POST['id'];
            if ($id) {
                $servicio = $controlador->obtenerServicioPorId($id);
                require __DIR__ . '/../app/vistas/servicios/editar_servicio.php';
            } else {
                echo "ID no válido.";
            }
            exit();
        }
    }

    if ($accion === 'actualizar') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];

        if ($id && $nombre && $duracion && $precio) {
            $controlador->editarServicio($id, $nombre, $duracion, $precio, $descripcion);
            header('Location: index_servicios.php');
        } else {
            echo "Datos incompletos para actualizar.";
        }
        exit();
    }

    if ($accion === 'eliminar') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $controlador->eliminarServicio($id);
            header('Location: index_servicios.php');
        } else {
            echo "ID no válido para eliminar.";
        }
        exit();
    }
}

echo "Acción no reconocida.";
