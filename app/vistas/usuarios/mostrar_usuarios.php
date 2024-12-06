<?php
include __DIR__ . '/../../config/acceso.php';
verificarAcceso(['gerente']);

include __DIR__ . '/../../../plantillas/cabecera.php';
include __DIR__ . '/../../../plantillas/barra_navegacion.php';



$contador = 1;
?>

<div class="container mt-5 embed-responsive">
    <h1 class="text-center mb-4">Usuarios</h1>

    <div class="text-right mb-3">
        <a href="/public/index_usuarios.php?accion=crear" class="btn btn-success">Añadir Usuario</a>
    </div>

    <?php if (!empty($usuarios)) : ?>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nº</th>
                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Rol</th>
                    <th>Activo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $contador++ ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                        <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                        <td><?= htmlspecialchars($usuario['rol']) ?></td>
                        <td><?= $usuario['activo'] ? 'Sí' : 'No' ?></td>
                        <td class="text-center">

                            <form method="GET" action="/public/index_usuarios.php" style="display:inline;">
                                <input type="hidden" name="accion" value="editar">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Modificar</button>
                            </form>

                            <form method="POST" action="/public/index_usuarios.php" style="display:inline;">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmarEliminacion()">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p class="text-center">No hay usuarios registrados.</p>
    <?php endif; ?>
</div>
<script src="/public/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmarEliminacion() {
        return confirm("¿Estás seguro de que deseas eliminar este trabajador?");
    }
</script>
<?php
include __DIR__ . '/../../../plantillas/pie.php';
?>