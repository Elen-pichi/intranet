<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Centro</h1>
    <form method="POST" action="/public/index_centros.php">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($centro['id']); ?>">

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($centro['nombre']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo htmlspecialchars($centro['direccion']); ?>" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($centro['telefono']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="/public/index_centros.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>