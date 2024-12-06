<?php
include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente']);

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Usuario</h1>
    <form method="POST" action="/public/index_usuarios.php">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Dejar vacío para no cambiar">
        </div>

        <div class="form-group">
            <label for="rol">Rol:</label>
            <select class="form-control" name="rol" id="rol" required>
                <option value="gerente" <?= $usuario['rol'] === 'gerente' ? 'selected' : '' ?>>Gerente</option>
                <option value="administrador" <?= $usuario['rol'] === 'administrador' ? 'selected' : '' ?>>Administrador</option>
                <option value="coordinador" <?= $usuario['rol'] === 'coordinador' ? 'selected' : '' ?>>Coordinador</option>
                <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
            </select>
        </div>

        <div class="form-group">
            <label for="activo">Activo:</label>
            <input type="checkbox" name="activo" id="activo" <?= $usuario['activo'] ? 'checked' : ''; ?>>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="/public/index_usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>
