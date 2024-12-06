<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador', 'coordinador', 'usuario']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Registrar Nueva Venta</h1>
    <form method="POST" action="/public/index_ventas.php">
        <input type="hidden" name="accion" value="crear">

        <div class="form-group mb-3">
            <div class="row">
                <div class="col-md-2">
                    <!-- Campo para mostrar el número de venta -->

                    <label for="numero">Número de Venta:</label>
                    <input type="text" class="form-control" name="numero" id="numero" value="<?= htmlspecialchars($numero) ?>" readonly>

                </div>
                <!-- Campo para seleccionar el centro -->

                <div class="col-md-4">
                    <label for="id_centro">Centro:</label>
                    <select class="form-control" name="id_centro" required <?= $centro ? 'readonly' : '' ?>>
                        <?php if ($centro): ?>
                            <option value="<?= htmlspecialchars($centro['id']) ?>" selected>
                                <?= htmlspecialchars($centro['nombre']) ?>
                            </option>
                        <?php else: ?>
                            <option value="">Seleccione un centro</option>
                            <?php foreach ($centros as $centroItem): ?>
                                <option value="<?= htmlspecialchars($centroItem['id']) ?>">
                                    <?= htmlspecialchars($centroItem['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>


                <!-- Campo para seleccionar el trabajador -->
                <div class="col-md-4">
                    <label for="id_trabajador">Empleado:</label>
                    <select class="form-control" name="id_trabajador" required <?= $trabajador ? 'readonly' : '' ?>>
                        <?php if ($trabajador): ?>
                            <option value="<?= htmlspecialchars($trabajador['id']) ?>" selected>
                                <?= htmlspecialchars($trabajador['nombre'] . ' ' . $trabajador['apellidos']) ?>
                            </option>
                        <?php else: ?>
                            <option value="">Seleccione un empleado</option>
                            <?php foreach ($trabajadores as $trabajadorItem): ?>
                                <option value="<?= htmlspecialchars($trabajadorItem['id']) ?>">
                                    <?= htmlspecialchars($trabajadorItem['nombre'] . ' ' . $trabajadorItem['apellidos']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Campo para seleccionar la fecha -->
            </div>
        </div>


        <div class="col-md-3">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" name="fecha" value="<?= date('Y-m-d') ?>" required>
        </div>



        <!-- Contenedor para los servicios -->
        <div id="servicios-container">
            <div class="servicio-item mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="servicio-nombre">Servicio:</label>
                        <select class="form-control servicio-nombre" name="servicios[0][id_servicio]" required>
                            <option value="">Seleccione un servicio</option>
                            <?php foreach ($servicios as $servicio): ?>
                                <option value="<?= htmlspecialchars($servicio['id']) ?>"
                                    data-duracion="<?= htmlspecialchars(json_encode($servicio['duracion'])) ?>"
                                    data-precio="<?= htmlspecialchars($servicio['precio']) ?>">
                                    <?= htmlspecialchars($servicio['nombre']) . '-' . ($servicio['duracion']) . '(min.)' ?>
                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>



                    <div class="col-md-2">
                        <label for="duracion">Duración:</label>
                        <select class="form-control duracion" name="servicios[0][duracion]" required>
                            <option value="">Seleccione la duración</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" class="form-control cantidad" name="servicios[0][cantidad]" min="1" value="1" required>
                    </div>
                    <div class="col-md-2">
                        <label for="precio_unitario">Precio Unitario:</label>
                        <input type="text" class="form-control precio_unitario" name="servicios[0][precio_unitario]" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="subtotal">Subtotal:</label>
                        <input type="text" class="form-control precio" name="servicios[0][subtotal]" readonly>
                    </div>
                </div>
            </div>
        </div>


        <!-- Botón para añadir más servicios -->
        <div class="text-right mb-3">
            <button type="button" id="agregar-servicio" class="btn btn-primary">Agregar Servicio</button>
        </div>

        <div class="row">
            <!-- Total de la venta -->
            <div class="col-md-4">
                <label for="importe_total">Total:</label>
                <input type="text" class="form-control" id="importe_total" name="importe_total" readonly>
            </div>
            <!-- Tipo de transacción -->
            <div class="col-md-5">
                <label for="tipo_transaccion">Forma de Pago:</label>
                <select class="form-control" name="tipo_transaccion" required>
                    <option value="">Seleccione una forma de pago</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Bizum">Bizum</option>
                </select>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success">Registrar Venta</button>
            <a href="/public/index_ventas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>


<script src="/public/js/funciones-ventas.js"></script>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>