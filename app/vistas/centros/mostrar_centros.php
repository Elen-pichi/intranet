<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

$contador= 1;
?>

<div class="container mt-5 embed-responsive">
    <h1 class="text-center mb-4">Centros</h1>

    <div class="text-right mb-3">
        <a href="/public/index_centros.php?accion=crear" class="btn btn-success">Nuevo Centro</a>
    </div>

    <?php if (!empty($centros)) : ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($centros as $centro) : ?>
                    <tr>
                        
                        <td><?php echo $contador++; ?></td>
                        <td><?php echo htmlspecialchars($centro['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($centro['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($centro['telefono']); ?></td>
                        <td class="text-center">

                            <form method="POST" action="/public/index_centros.php" style="display:inline;">
                                <input type="hidden" name="accion" value="editar">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($centro['id']); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
                            </form>

                            <form method="POST" action="/public/index_centros.php" style="display:inline;">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($centro['id']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">No hay centros registrados.</p>
    <?php endif; ?>
</div>

<script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmarEliminacion() {
        return confirm("¿Estás seguro de que deseas eliminar este centro?");
    }
</script>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>