<?php
function verificarAcceso($rolesPermitidos) {
    // Iniciar la sesión si no está activa
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['rol'])) {
        header('Location:/../../public/login.php');
        exit;
    }

    // Verificar si el rol del usuario está permitido
    if (!in_array($_SESSION['rol'], $rolesPermitidos)) {
        header('Location:/../../plantillas/no_autorizado.php');
        exit;
    }

}
?>
