<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios - Egant Consultores</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <h2>Gestionar Usuarios</h2>

    <?php if (!empty($success)) : ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <div class="alert alert-error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <!-- Formulario de edición si se seleccionó un usuario -->
    <?php if (!empty($usuarioEditar)) : ?>
        <h3>Editar Usuario</h3>
        <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=gestionar_usuarios">
            <input type="hidden" name="id" value="<?php echo (int)$usuarioEditar['id']; ?>">
            <input type="hidden" name="accion" value="guardar">

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuarioEditar['nombre']); ?>" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuarioEditar['correo']); ?>" required>

            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($usuarioEditar['fecha_nacimiento']); ?>">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($usuarioEditar['direccion']); ?>">

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuarioEditar['telefono']); ?>">

            <label for="rol_id">Rol:</label>
            <select id="rol_id" name="rol_id">
                <option value="1" <?php if ($usuarioEditar['rol_id'] == 1) echo 'selected'; ?>>Administrador</option>
                <option value="2" <?php if ($usuarioEditar['rol_id'] == 2) echo 'selected'; ?>>Usuario</option>
            </select>

            <button type="submit">Guardar cambios</button>
        </form>
    <?php endif; ?>

    <!-- Tabla de usuarios -->
    <?php if (!empty($usuarios)) : ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha nacimiento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u) : ?>
                    <tr>
                        <td><?php echo (int)$u['id']; ?></td>
                        <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($u['correo']); ?></td>
                        <td><?php echo htmlspecialchars($u['fecha_nacimiento']); ?></td>
                        <td><?php echo htmlspecialchars($u['direccion']); ?></td>
                        <td><?php echo htmlspecialchars($u['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($u['rol']); ?></td>
                        <td>
                            <div class="acciones">
                                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=gestionar_usuarios">
                                    <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
                                    <button type="submit" name="accion" value="editar" class="btn btn-edit">✏️</button>
                                    <button type="submit" name="accion" value="eliminar" class="btn btn-delete" onclick="return confirm('¿Eliminar este usuario?');">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay usuarios registrados.</p>
    <?php endif; ?>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>

