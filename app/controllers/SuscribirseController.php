<?php
require_once __DIR__ . '/../models/Suscripcion.php';
require_once __DIR__ . '/../config.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;

if (!$usuario_id) {
    header("Location: " . BASE_URL . "index.php?page=login&error=login_required");
    exit;
}

$suscripcionModel = new Suscripcion();
$success = $error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = $_POST['plan_id'] ?? null;

    if ($plan_id) {
        $ok = $suscripcionModel->crearSuscripcion($usuario_id, $plan_id);
        $success = $ok ? "Suscripción activada correctamente." : "Error al activar la suscripción.";
    } else {
        $error = "Debe seleccionar un plan válido.";
    }
}

include __DIR__ . '/../views/suscribirse.php';
