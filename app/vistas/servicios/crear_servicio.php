<?php 

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Agregar Nuevo Servicio</h1>

        <form method="POST" action="/public/index_servicios.php">
            <input type="hidden" name="accion" value="crear">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="duracion">Duración:</label>
                <input type="text" class="form-control" name="duracion" id="duracion" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion">
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="/public/index_servicios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>


<?php 
include __DIR__ . '/../../../plantillas/pie.php';
?>