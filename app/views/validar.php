<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Validar Publicaciones - Egant Consultores</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>
    
    <h2>Validar Publicaciones</h2>

    <?php if (!empty($pendientes)) : ?>
        <div class="pendientes">
            <?php foreach ($pendientes as $pub) : ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($pub['titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($pub['descripcion']); ?></p>
                    <p><strong>Precio:</strong> S/. <?php echo number_format($pub['precio'], 2); ?></p>
                    <p><em>Estado actual: <?php echo htmlspecialchars($pub['estado']); ?></em></p>

                    <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=validar">
                        <input type="hidden" name="id" value="<?php echo $pub['id']; ?>">
                        <button type="submit" name="accion" value="aprobar">Aprobar</button>
                        <button type="submit" name="accion" value="rechazar">Rechazar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No hay publicaciones pendientes.</p>
    <?php endif; ?>
    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
