<?php

use App\Config\Conexion;

session_start();

require_once __DIR__ . '/../app/config/conexion.php'; // Archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales
    $dbConexion = Conexion::obtenerConexion();
    $consulta = $dbConexion->prepare('SELECT * FROM usuarios WHERE email = ?');
    $consulta->execute([$email]);
    $usuario = $consulta->fetch();

    if ($usuario && password_verify($password, $usuario['password'])) {
        // Iniciar sesión
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['rol'] = $usuario['rol'];       

        header('Location:index.php');
        exit;
    } else {
        $error = 'Credenciales incorrectas';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="login.php" class="mt-5">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php endif; ?>
                   

                    <div class="text-center mt-5">
                    <a class="collapse-item" href="../plantillas//en_construccion.php">Olvidé mi contraseña</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>



