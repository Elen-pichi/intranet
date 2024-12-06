<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controladores\UsuariosControlador;

$controlador = new UsuariosControlador();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['accion'])) {
    $controlador->index();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'crear') {
    $controlador->crearVista();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'editar' && isset($_GET['email'])) {
    $email = $_GET['email'];
    $controlador->editarVista($email);
    exit();
}

/*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['accion']) && $_GET['accion'] === 'verificar_email') {
    $controlador->verificarEmail();
    exit();
}
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $accion = $_POST['accion'];

    if ($accion === 'crear') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];

        if ($email && $password && $rol) {
            $controlador->crearUsuario($email, $password, $rol);
            header('Location: index_usuarios.php');
            exit();
        } else {
            echo "Faltan datos para crear un usuario.";
        }
    }

    if ($accion === 'actualizar') {
        $email = $_POST['email'];
        $password = $_POST['password'] ?? null;
        $rol = $_POST['rol'];
        $activo = isset($_POST['activo']) ? 1 : 0;

        if ($email && $rol) {
            $controlador->editarUsuario($email, $password, $rol, $activo);
            header('Location: index_usuarios.php');
        } else {
            echo "Datos incompletos para actualizar el usuario.";
        }
        exit();
    }

    if ($accion === 'eliminar') {
        $email = $_POST['email'] ?? null;

        if ($email) {
            $controlador->eliminarUsuario($email);
            header('Location: index_usuarios.php');
        } else {
            echo "Email no válido para eliminar.";
        }
        exit();
    }
}
