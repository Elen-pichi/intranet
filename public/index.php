<!-- página principal de la página principal -->

<?php
require __DIR__ . '/../app/config/acceso.php';
require __DIR__ . '/../vendor/autoload.php';

// Verificar si el usuario ha iniciado sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirigir al login si no hay sesión activa
if (!isset($_SESSION['email'])) {
    header('Location: /public/login.php');
    exit();
}

include __DIR__ . '/../plantillas/cabecera.php';
include __DIR__ . '/../plantillas/barra_navegacion.php';
?>

<div class="card text-bg-dark">
    <img src="/public/imgs/relax.png" class="card-img" alt="relax">
    <div class="card-img-overlay">
        <h3 class="card-title text-dark text-center">BIENVENIDO A TU INTRANET</h3>
    </div>
</div>

<?php include __DIR__ . '/../plantillas/pie.php'; ?>
