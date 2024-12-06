<?php
include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Agregar Nuevo Usuario</h1>
    <form method="POST" action="/public/index_usuarios.php">
        <input type="hidden" name="accion" value="crear">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select class="form-control" name="rol" id="rol" required>
                <option value="gerente">Gerente</option>
                <option value="administrador">Administrador</option>
                <option value="coordinador">Coordinador</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="/public/index_usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>
