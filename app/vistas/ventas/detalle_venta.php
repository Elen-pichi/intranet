<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador', 'coordinador','usuario']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Detalle de la Venta</h1>

    <!-- Detalles de la Venta -->
    <div class="card mb-4">
        <div class="card-header">Información General</div>
        <div class="card-body">
            <p><strong>Número de Venta:</strong> <?= htmlspecialchars($venta['numero']) ?></p>
            <p><strong>Centro:</strong> <?= htmlspecialchars($venta['centro_nombre']) ?></p>
            <p><strong>Trabajador:</strong> <?= htmlspecialchars($venta['trabajador_nombre'] . ' ' . $venta['trabajador_apellidos']) ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars($venta['fecha']) ?></p>
            <p><strong>Tipo de Transacción:</strong> <?= htmlspecialchars($venta['tipo_transaccion']) ?></p>
            <p><strong>Importe Total:</strong> <?= htmlspecialchars(number_format($venta['importe_total'], 2)) ?> €</p>
        </div>
    </div>

    <!-- Servicios Asociados -->
    <div class="card">
        <div class="card-header">Servicios Asociados</div>
        <div class="card-body">
            <?php if (!empty($servicios)): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Duración</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicios as $servicio): ?>
                            <tr>
                                <td><?= htmlspecialchars($servicio['nombre']) ?></td>
                                <td><?= htmlspecialchars($servicio['duracion']) ?> min</td>
                                <td><?= htmlspecialchars($servicio['cantidad']) ?></td>
                                <td><?= htmlspecialchars(number_format($servicio['precio'], 2)) ?> €</td>
                                <td><?= htmlspecialchars(number_format($servicio['subtotal'], 2)) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No hay servicios asociados a esta venta.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Botón para regresar -->
    <div class="text-center mt-4">
        <a href="/public/index_ventas.php" class="btn btn-secondary">Volver</a>
    </div>
</div>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>
