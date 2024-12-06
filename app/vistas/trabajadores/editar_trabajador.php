<?php
include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Editar Empleado</h1>
        <form method="POST" action="/public/index_trabajadores.php">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($trabajador['id']); ?>">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($trabajador['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo htmlspecialchars($trabajador['apellidos']); ?>" required>
            </div>
            <div class="form-group">
                <label for="e_mail">E_mail:</label>
                <input type="email" class="form-control" name="e_mail" id="e_mail" value="<?php echo htmlspecialchars($trabajador['e_mail']); ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo htmlspecialchars($trabajador['telefono']); ?>">
            </div>
            <div class="form-group">
                <label for="salario">Salario:</label>
                <input type="number" step="0.01" class="form-control" name="salario" id="salario" value="<?php echo htmlspecialchars($trabajador['salario']); ?>">
            </div>
            <div class="form-group">
                <label for="id_centro">Centro Pertenencia:</label>
                <select class="form-control" name="id_centro" id="id_centro" required>
                    <option value="">Seleccione un centro</option>
                    <?php foreach ($centros as $centro) : ?>
                        <option value="<?php echo htmlspecialchars($centro['id']); ?>"
                            <?php echo $trabajador['id_centro'] == $centro['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($centro['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="/public/index_trabajadores.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>