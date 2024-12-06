<?php 

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Agregar Nuevo Centro</h1>

        <form method="POST" action="/public/index_centros.php">
            <input type="hidden" name="accion" value="crear">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" name="direccion" id="direccion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="/public/index_centros.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>

<?php 
include __DIR__ . '/../../../plantillas/pie.php';
?>