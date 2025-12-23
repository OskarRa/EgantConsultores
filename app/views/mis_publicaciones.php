<?php 
$pageTitle = "Mis Publicaciones - Egant Consultores";
include __DIR__ . '/header.php';
?>

<h2>Mis Publicaciones</h2>

<?php if (!empty($success)) : ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<?php if (!empty($misPublicaciones)) : ?>
    <div class="mis-publicaciones">
        <?php foreach ($misPublicaciones as $pub) : ?>
            <div class="card p-3 mb-3">
                <h3><?php echo htmlspecialchars($pub['titulo']); ?></h3>
                <p><?php echo htmlspecialchars($pub['descripcion']); ?></p>
                <p><strong>Precio:</strong> S/. <?php echo number_format($pub['precio'], 2); ?></p>
                <p><em>Estado: <?php echo htmlspecialchars($pub['estado']); ?></em></p>

                <form method="POST" action="<?php echo BASE_URL; ?>index.php?page=mis_publicaciones">
                    <input type="hidden" name="id" value="<?php echo (int)$pub['id']; ?>">
                    <button type="submit" name="accion" value="eliminar" onclick="return confirm('¿Eliminar esta publicación?');" class="btn-delete">
                        Eliminar
                    </button>
                </form>

                <a href="<?php echo BASE_URL; ?>index.php?page=publicar&id=<?php echo (int)$pub['id']; ?>">
                    <button type="button" class="btn-edit">Editar</button>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No tienes publicaciones registradas.</p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
