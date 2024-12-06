<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';


$contador = 1;
?>

<body>
    <div class="container mt-5 embed-responsive">
        <h1 class="text-center mb-4">Servicios</h1>

        <div class="text-right mb-3">
            <a href="/public/index_servicios.php?accion=crear" class="btn btn-success">Nuevo Servicio</a>
        </div>

        <?php if (!empty($servicios)) : ?>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Duración</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicios as $servicio) : ?>
                        <tr>
                            <td><?php echo $contador++; ?></td>
                            <td><?php echo htmlspecialchars($servicio['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['duracion']); ?></td>
                            <td><?php echo htmlspecialchars($servicio['precio']); ?></td>
                            <td><?php echo isset($servicio['descripcion']) ? htmlspecialchars($servicio['descripcion']) : ''; ?></td>
                            <td class="text-center">

                                <form method="POST" action="/public/index_servicios.php" style="display:inline;">
                                    <input type="hidden" name="accion" value="editar">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id']); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
                                </form>

                                <form method="POST" action="/public/index_servicios.php" style="display:inline;">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($servicio['id']); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmarEliminacion()">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-center">No hay servicios registrados.</p>
        <?php endif; ?>
    </div>

    <script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar este servicio?");
        }
    </script>
</body>

</html>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>