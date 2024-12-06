<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador', 'coordinador', 'usuario']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Venta</h1>
    <form method="POST" action="/public/index_ventas.php">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id" value="<?= htmlspecialchars($venta['id']) ?>">

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-md-2">
                    <!-- Campo para mostrar el número de venta -->
                    <label for="numero">Número de Venta:</label>
                    <input type="text" class="form-control" name="numero" id="numero" value="<?= htmlspecialchars($venta['numero']) ?>" readonly>
                    <input type="hidden" name="numero" value="<?= htmlspecialchars($venta['numero']) ?>">
                    <?php var_dump($venta['numero']); ?>

                </div>

                <div class="col-md-4">
                    <label for="id_centro">Centro:</label>
                    <!-- Mostrar el nombre del centro como solo lectura -->
                    <input type="text" class="form-control" value="<?= htmlspecialchars($venta['centro_nombre']) ?>" readonly>
                    <!-- Campo oculto para enviar el valor del centro -->
                    <input type="hidden" name="id_centro" value="<?= htmlspecialchars($venta['id_centro']) ?>">
                </div>

                <div class="col-md-4">
                    <label for="id_trabajador">Empleado:</label>
                    <!-- Mostrar el nombre del trabajador como solo lectura -->
                    <input type="text" class="form-control" value="<?= htmlspecialchars($venta['trabajador_nombre'] . ' ' . $venta['trabajador_apellidos']) ?>" readonly>
                    <!-- Campo oculto para enviar el valor del trabajador -->
                    <input type="hidden" name="id_trabajador" value="<?= htmlspecialchars($venta['id_trabajador']) ?>">
                </div>
            </div>
        </div>

        <!-- Campo para seleccionar la fecha -->
        <div class="col-md-3 mb-3">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" name="fecha" value="<?= htmlspecialchars($venta['fecha']) ?>" required>
        </div>

        <!-- Contenedor para los servicios -->
        <div id="servicios-container">
            <?php foreach ($serviciosVenta as $index => $servicio): ?>
                <div class="servicio-item mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="servicio-nombre-<?= $index ?>">Servicio:</label>
                            <select class="form-control servicio-nombre" name="servicios[<?= $index ?>][id_servicio]" data-index="<?= $index ?>" required>
                                <option value="">Seleccione un servicio</option>
                                <?php foreach ($servicios as $servicioItem): ?>
                                    <option value="<?= htmlspecialchars($servicioItem['id']) ?>"
                                        data-duracion="<?= htmlspecialchars($servicioItem['duracion']) ?>"
                                        data-precio="<?= htmlspecialchars($servicioItem['precio']) ?>"
                                        <?= $servicio['servicio'] == $servicioItem['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($servicioItem['nombre']) . ' - ' . $servicioItem['duracion'] . ' min.' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="duracion-<?= $index ?>">Duración:</label>
                            <input type="text" class="form-control duracion" name="servicios[<?= $index ?>][duracion]"
                                value="<?= htmlspecialchars($servicio['duracion']) ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="cantidad-<?= $index ?>">Cantidad:</label>
                            <input type="number" class="form-control cantidad" name="servicios[<?= $index ?>][cantidad]" min="1"
                                value="<?= htmlspecialchars($servicio['cantidad']) ?>" required>
                        </div>

                        <div class="col-md-2">
                            <label for="precio_unitario-<?= $index ?>">Precio Unitario:</label>
                            <input type="text" class="form-control precio_unitario" name="servicios[<?= $index ?>][precio_unitario]"
                                value="<?= htmlspecialchars($servicio['precio']) ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="subtotal-<?= $index ?>">Subtotal:</label>
                            <input type="text" class="form-control precio" name="servicios[<?= $index ?>][subtotal]"
                                value="<?= htmlspecialchars($servicio['subtotal']) ?>" readonly>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



        <!-- Botón para añadir más servicios -->
        <div class="text-right mb-3">
            <button type="button" id="agregar-servicio" class="btn btn-primary">Agregar Servicio</button>
        </div>

        <div class="row">
            <!-- Total de la venta -->
            <div class="col-md-4">
                <label for="importe_total">Total:</label>
                <input type="text" class="form-control" id="importe_total" name="importe_total"
                    value="<?php echo ($venta['importe_total']) ?>" readonly>
            </div>

            <!-- Tipo de transacción -->
            <div class="col-md-5">
                <label for="tipo_transaccion">Forma de Pago:</label>
                <select class="form-control" name="tipo_transaccion" required>
                    <option value="Tarjeta" <?= $venta['tipo_transaccion'] === 'Tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
                    <option value="Efectivo" <?= $venta['tipo_transaccion'] === 'Efectivo' ? 'selected' : '' ?>>Efectivo</option>
                    <option value="Bizum" <?= $venta['tipo_transaccion'] === 'Bizum' ? 'selected' : '' ?>>Bizum</option>
                </select>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="/public/index_ventas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script src="/public/js/funciones-ventas.js"></script>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>