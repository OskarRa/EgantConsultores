<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - Egant Consultores</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    <main class="content">
        <h2>Contáctanos</h2>
        <form method="POST" action="index.php?page=contacto">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </main>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
