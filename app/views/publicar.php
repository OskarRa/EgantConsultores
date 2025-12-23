<?php 
$pageTitle = isset($publicacion) ? "Editar publicación - Egant Consultores" : "Publicar Bien - Egant Consultores";
include __DIR__ . '/header.php';
?>

<h2><?php echo isset($publicacion) ? "Editar publicación" : "Nueva publicación"; ?></h2>

<?php if (!empty($error)) : ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (!empty($success)) : ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<form method="POST" action="<?php echo BASE_URL; ?>index.php?page=publicar" enctype="multipart/form-data" class="form-publicar">

    <?php if (isset($publicacion['id'])): ?>
        <input type="hidden" name="id" value="<?php echo (int)$publicacion['id']; ?>">
    <?php endif; ?>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($publicacion['titulo'] ?? ''); ?>" required>

    <label for="categoria">Categoría:</label>
    <select name="categoria_id" id="categoria" required>
        <option value="1" <?php if (($publicacion['categoria_id'] ?? '') == 1) echo 'selected'; ?>>Inmuebles</option>
        <option value="2" <?php if (($publicacion['categoria_id'] ?? '') == 2) echo 'selected'; ?>>Vehículos</option>
        <option value="3" <?php if (($publicacion['categoria_id'] ?? '') == 3) echo 'selected'; ?>>General</option>
    </select>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($publicacion['descripcion'] ?? ''); ?></textarea>

    <label for="tipo_operacion">Tipo de operación:</label> 
    <select name="tipo_operacion" id="tipo_operacion" class="form-select"> 
        <option value="venta" <?php if (($publicacion['tipo_operacion'] ?? '') === 'venta') echo 'selected'; ?>>Venta</option> 
        <option value="alquiler" <?php if (($publicacion['tipo_operacion'] ?? '') === 'alquiler') echo 'selected'; ?>>Alquiler</option> 
    </select>


    <label for="precio">Precio:</label>
    <input type="number" step="0.01" id="precio" name="precio" value="<?php echo htmlspecialchars($publicacion['precio'] ?? ''); ?>" required>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="imagen">

    <?php if (!empty($publicacion['imagen'])): ?>
        <p>Imagen actual: <img src="<?php echo BASE_URL; ?>images/<?php echo htmlspecialchars($publicacion['imagen']); ?>" style="max-width:150px;"></p>
    <?php endif; ?>

    <button type="submit"><?php echo isset($publicacion) ? "Actualizar" : "Publicar"; ?></button>
</form>

<?php include __DIR__ . '/footer.php'; ?>
