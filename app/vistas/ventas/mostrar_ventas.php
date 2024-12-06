<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador', 'coordinador', 'usuario']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Ventas</h1>

    <div class="text-right mb-3">
        <a href="/public/index_ventas.php?accion=crear" class="btn btn-success">Nueva Venta</a>
    </div>

    <?php if (!empty($ventas)) : ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nº Venta</th>
                    <th>Empleado</th>
                    <th>Centro</th>
                    <th>Fecha</th>
                    <th>Tipo de Transacción</th>
                    <th>Total</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= htmlspecialchars($venta['numero']) ?></td>
                        <td><?= htmlspecialchars($venta['trabajador_nombre'] . ' ' . $venta['trabajador_apellidos']) ?></td>
                        <td><?= htmlspecialchars($venta['centro_nombre']) ?></td>
                        <td><?= htmlspecialchars($venta['fecha']) ?></td>
                        <td><?= htmlspecialchars($venta['tipo_transaccion']) ?></td>
                        <td><?= htmlspecialchars(number_format($venta['importe_total'] ?? 0, 2)) ?> €</td>
                        <td class="text-center">
                            <a href="/public/index_ventas.php?accion=detalles&id=<?= htmlspecialchars($venta['id']) ?>" class="btn btn-primary btn-sm">Detalles</a>
                            <a href="/public/index_ventas.php?accion=editar&id=<?= htmlspecialchars($venta['id']) ?>" class="btn btn-primary btn-sm">Modificar</a>
                            <form method="POST" action="/public/index_ventas.php" style="display:inline;">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($venta['id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">No hay ventas registradas.</p>
    <?php endif; ?>
</div>

<script src="/public/js/funciones-ventas.js"></script>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>
