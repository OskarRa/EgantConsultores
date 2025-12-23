<?php
$pageTitle = "Catálogo de todos los bienes";
include 'header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Catálogo de todos los bienes</h2>

    <!-- Buscador -->
    <form method="GET" action="index.php" class="d-flex buscador-form">
        <input type="hidden" name="page" value="catalogo">
        <input 
            type="text" 
            name="q" 
            class="form-control buscador-input me-2" 
            placeholder="Buscar bienes..."
            value="<?php echo htmlspecialchars($_GET['q'] ?? '') ?>"
        >
        <button class="buscador-btn">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<!-- Filtros -->
<form method="GET" action="index.php" class="row mb-4"> 
    <input type="hidden" name="page" value="catalogo"> 
    <!-- Categoría --> 
    <div class="col-md-4"> 
        <label for="tipo" class="form-label">Categoría</label> 
        <select name="tipo" id="tipo" class="form-select"> 
            <option value="">Todos</option> 
            <option value="inmuebles" <?php if(($_GET['tipo'] ?? '')==='inmuebles') echo 'selected'; ?>>Inmuebles</option> 
            <option value="vehiculos" <?php if(($_GET['tipo'] ?? '')==='vehiculos') echo 'selected'; ?>>Vehículos</option> 
            <option value="general" <?php if(($_GET['tipo'] ?? '')==='general') echo 'selected'; ?>>General</option> 
        </select> 
    </div> 
    <!-- Operación --> 
    <div class="col-md-4"> 
        <label for="operacion" class="form-label">Tipo de operación</label> 
        <select name="operacion" id="operacion" class="form-select"> 
            <option value="ambos" <?php if(($_GET['operacion'] ?? '')==='ambos') echo 'selected'; ?>>Venta y Alquiler</option> 
            <option value="venta" <?php if(($_GET['operacion'] ?? '')==='venta') echo 'selected'; ?>>Solo Venta</option> 
            <option value="alquiler" <?php if(($_GET['operacion'] ?? '')==='alquiler') echo 'selected'; ?>>Solo Alquiler</option> 
        </select> 
    </div> 
    <!-- Precio --> 
    <div class="col-md-4"> 
        <label for="orden" class="form-label">Ordenar por precio</label> 
        <select name="orden" id="orden" class="form-select"> 
            <option value="asc" <?php if(($_GET['orden'] ?? '')==='asc') echo 'selected'; ?>>Menor a mayor</option> 
            <option value="desc" <?php if(($_GET['orden'] ?? '')==='desc') echo 'selected'; ?>>Mayor a menor</option> 
        </select> 
    </div> 
    
    <div class="col-12 mt-3"> 
        <button type="submit" class="btn btn-primary">Aplicar filtros</button> 
    </div> 
</form>

<!-- Tarjetas -->
<?php if (!empty($publicaciones)): ?>
    <?php foreach ($publicaciones as $p): ?>

        <div class="card mb-4 shadow-sm">
            <div class="row g-0">

                <!-- Imagen -->
                <div class="col-md-4">
                    <img 
                        src="<?php echo BASE_URL . 'images/' . $p['imagen']; ?>"
                        class="img-fluid rounded-start object-fit-cover"
                        style="height: 250px;"
                        alt="Imagen del bien"
                    >
                </div>

                <!-- Datos -->
                <div class="col-md-8">
                    <div class="card-body">

                        <h5 class="card-title fw-bold">
                            <?php echo htmlspecialchars($p['titulo']); ?>
                        </h5>

                        <p class="card-text text-muted line-clamp-2">
                            <?php echo htmlspecialchars($p['descripcion']); ?>
                        </p>

                        <p class="fw-bold text-primary fs-4 mb-3">
                            S/. <?php echo number_format($p['precio'], 2); ?>
                        </p>

                        <a 
                            href="index.php?page=detalle&id=<?php echo $p['id']; ?>" 
                            class="btn btn-outline-primary"
                        >
                            Ver más
                        </a>

                    </div>
                </div>

            </div>
        </div>

    <?php endforeach; ?>

<?php else: ?>
    <p class="text-muted">No se encontraron resultados.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
