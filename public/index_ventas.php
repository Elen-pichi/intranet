<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controladores\VentasControlador;

session_start();
if (!isset($_SESSION['email'])) {
    header('Location: /public/login.php');
    exit();
}


$controlador = new VentasControlador();

try {
    // Manejo de solicitudes GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $accion = $_GET['accion'] ?? 'index'; // Por defecto, la acción es 'index'

        switch ($accion) {
            case 'index':
                $controlador->index(); // Listar ventas
                break;

            case 'crear':
                $controlador->crearVista(); // Mostrar formulario para crear venta
                break;

            case 'editar':
                if (!isset($_GET['id'])) {
                    throw new Exception("ID no especificado para editar.");
                }
                $controlador->editarVista($_GET['id']); // Mostrar formulario de edición
                break;

            case 'detalles':
                if (!isset($_GET['id'])) {
                    throw new Exception("ID no especificado para ver detalles.");
                }
                $controlador->detalleVista($_GET['id']); // Mostrar detalles de una venta
                break;

            default:
                throw new Exception("Acción desconocida: " . htmlspecialchars($accion));
        }
        exit();
    }

    // Manejo de solicitudes POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $accion = $_POST['accion'] ?? null;

        if ($accion === 'crear') {
            $controlador->crearVenta($_POST); // Registrar una nueva venta
        } elseif ($accion === 'actualizar') {
            $controlador->editarVenta($_POST); // Actualizar una venta existente
        } elseif ($accion === 'eliminar') {
            if (!isset($_POST['id'])) {
                throw new Exception("ID no especificado para eliminar.");
            }
            $controlador->eliminarVenta($_POST['id']); // Eliminar una venta
        } else {
            throw new Exception("Acción POST no válida: " . htmlspecialchars($accion));
        }
        exit();
    }

    // Si no es GET ni POST, lanza una excepción
    throw new Exception("Método HTTP no soportado: " . $_SERVER['REQUEST_METHOD']);
} catch (\Exception $e) {
    error_log("Error en index_ventas: " . $e->getMessage());
    echo "Ha ocurrido un error. Por favor, intenta nuevamente.";
}




