<?php 

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Servicio</h1>
        <form method="POST" action="/public/index_servicios.php">
            <input type="hidden" name="accion" value="actualizar">            
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id']); ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($servicio['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="duracion">Duración:</label>
                <input type="number" class="form-control" name="duracion" id="duracion" value="<?php echo htmlspecialchars($servicio['duracion']); ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" name="precio" id="precio" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo htmlspecialchars($servicio['descripcion']); ?>">
            </div>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="/public/index_servicios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

<?php 
include __DIR__ . '/../../../plantillas/pie.php';
?>