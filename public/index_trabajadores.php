<?php
require __DIR__ . '/../vendor/autoload.php';


use App\Controladores\TrabajadoresControlador;

$controlador = new TrabajadoresControlador();

// Si no se pasa ninguna acción, mostrar el listado
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['accion'])) {
   $controlador->index();
    exit();
}

//obtención del listado de centros
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'crear') {
    $controlador->crearVista();
    exit();
}

// Cargar la vista de edición (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['id'])) {
    $id = $_GET['id']; // Asegúrate de que el ID sea válido
    $controlador->editarVista($id);
    exit();
}

//ruta para verificar si un e_mail ya exite en la bbdd
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['accion']) && $_GET['accion'] === 'verificar_email') {
    $controlador->verificarEmail();
    exit();
}

//si se pasa acción crear, actualizar o eliminar x Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'crear') {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $e_mail = $_POST['e_mail'];
        $telefono = $_POST['telefono'];
        $salario = $_POST['salario'];
        $id_centro = $_POST['id_centro'];

        if ($nombre && $apellidos && $e_mail && $id_centro) {

            $controlador->crearTrabajador($nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro);
            header('Location: index_trabajadores.php');
            exit();
        } else {
            echo "Faltan datos para añadir un nuevo trabajador.";
        }
    }

    if ($accion === 'actualizar') {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $e_mail = $_POST['e_mail'];
        $telefono = $_POST['telefono'];
        $salario = $_POST['salario'];
        $id_centro = $_POST['id_centro'];

        if ($id && $nombre && $apellidos && $e_mail && $id_centro) {
            $controlador->editarTrabajador($id, $nombre, $apellidos, $e_mail, $telefono, $salario, $id_centro);
            header('Location: index_trabajadores.php');
        } else {
            echo "Datos incompletos para actualizar.";
        }
        exit();
    }

    if ($accion === 'eliminar') {
        $id = $_POST['id'] ?? null;

        if ($id) {
            $controlador->eliminarTrabajador($id);
            header('Location: index_trabajadores.php');
        } else {
            echo "ID no válido para eliminar.";
        }
        exit();
    }
}


echo "Acción no reconocida.";
