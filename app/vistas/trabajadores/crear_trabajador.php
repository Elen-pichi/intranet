<?php

include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente', 'administrador']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';

?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Agregar Nuevo Empleado</h1>

        <form method="POST" action="/public/index_trabajadores.php">
            <input type="hidden" name="accion" value="crear">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" required>
            </div>
            <div class="form-group">
                <label for="e_mail">E_mail:</label>
                <input type="email" class="form-control" name="e_mail" id="e_mail" required>
                <div id="email-error" class="text-danger"></div>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" id="telefono" required>
            </div>
            <div class="form-group">
                <label for="salario">Salario:</label>
                <input type="number" step="0.01" class="form-control" name="salario" id="salario" required>
            </div>

            <div class="form-group">
                <label for="id_centro">Centro Pertenencia:</label>
                <select class="form-control" name="id_centro" id="id_centro" required>
                    <option value="">Selecciona un centro</option>
                    <?php foreach ($centros as $centro): ?>
                        <option value="<?php echo htmlspecialchars($centro['id']); ?>">
                            <?php echo htmlspecialchars($centro['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="/public/index_trabajadores.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#e_mail').on('blur', function() {
                const email = $(this).val();

                if (email) {
                    $.ajax({
                        url: '/public/index_trabajadores.php?accion=verificar_email',
                        type: 'POST',
                        data: {
                            e_mail: email
                        },
                        success: function(response) {
                            const data = JSON.parse(response);

                            if (data.exists) {
                                $('#email-error').text('Correo ya registrado, introduce otro distinto.');
                                $('#e_mail').addClass('is-invalid');
                            } else {
                                $('#email-error').text('');
                                $('#e_mail').removeClass('is-invalid');
                            }
                        },
                        error: function() {
                            $('#email-error').text('Hubo un error al verificar el correo.');
                        }
                    });
                }
            });
        });
    </script>


    <script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>