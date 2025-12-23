<?php 
$pageTitle = "Registro - Egant Consultores"; 
include __DIR__ . '/header.php'; 
?>

<main class="content">
    <h2>Registro de Usuario</h2>

    <?php if (isset($error)) : ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if (isset($success)) : ?>
        <p class="success"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=registro" class="form-registro">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono">

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required>

        <label for="confirmar_contraseña">Confirmar contraseña:</label>
        <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>

        <div class="checkbox">
            <input type="checkbox" id="terminos" name="terminos" required>
            <label for="terminos">Acepto los <a href="index.php?page=terminos">Términos</a> y la <a href="index.php?page=privacidad">Política de privacidad</a></label>
        </div>

        <button type="submit">Registrarse</button>
        <button type="reset">Cancelar</button>
    </form>
</main>

<?php include __DIR__ . '/footer.php'; ?>
