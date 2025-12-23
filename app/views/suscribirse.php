<?php 
$pageTitle = "Suscribirse - Egant Consultores"; 
include __DIR__ . '/header.php'; 
?>

<h2>Planes de Suscripción</h2>

<?php if (!empty($error)) : ?>
    <p class="error"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (!empty($success)) : ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<div class="row">
    <!-- Ejemplo de planes -->
    <div class="col-md-4">
        <div class="card p-3 mb-3">
            <h3>Plan Semanal</h3>
            <p>Duración: 7 días</p>
            <p>Precio: S/. 9.90</p>
            <p>Límite: 5 publicaciones</p>
            <form method="POST" action="index.php?page=suscribirse">
                <input type="hidden" name="plan_id" value="1">
                <button type="submit" class="btn btn-primary">Suscribirse</button>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 mb-3">
            <h3>Plan Mensual</h3>
            <p>Duración: 30 días</p>
            <p>Precio: S/. 24.90</p>
            <p>Límite: 20 publicaciones</p>
            <form method="POST" action="index.php?page=suscribirse">
                <input type="hidden" name="plan_id" value="2">
                <button type="submit" class="btn btn-primary">Suscribirse</button>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 mb-3">
            <h3>Plan Anual</h3>
            <p>Duración: 365 días</p>
            <p>Precio: S/. 199.00</p>
            <p>Límite: 300 publicaciones</p>
            <form method="POST" action="index.php?page=suscribirse">
                <input type="hidden" name="plan_id" value="3">
                <button type="submit" class="btn btn-primary">Suscribirse</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
