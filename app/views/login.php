<?php 
$pageTitle = "Login - Egant Consultores"; 
include __DIR__ . '/header.php'; 
?>

<h2>Acceso</h2>

<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <p class="success">Usuario registrado correctamente. Ahora puedes iniciar sesión.</p>
<?php endif; ?>

<?php if (isset($error)): ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="index.php?page=login" class="form-login">
    <label for="correo">Correo electrónico:</label>
    <input type="email" id="correo" name="correo" required>

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" required>

    <button type="submit">Ingresar</button>
</form>

<p class="text-center mt-3">
    <a href="index.php?page=registro">Registrarse</a> | 
    <a href="index.php?page=recuperar">Recuperar contraseña</a>
</p>

<?php include __DIR__ . '/footer.php'; ?>
