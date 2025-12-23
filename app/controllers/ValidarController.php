<?php
require_once __DIR__ . '/../models/Publicacion.php';

// Validar que el usuario sea administrador
if ($_SESSION['rol'] != 1) {
    $error = "Acceso denegado. Solo administradores pueden validar publicaciones.";
    include '../app/views/catalogo.php';
    exit;
}

$publicacionModel = new Publicacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $accion = $_POST['accion'];

    if ($accion === 'aprobar') {
        $resultado = $publicacionModel->cambiarEstado($id, 'aprobada');
        $success = $resultado ? "Publicación aprobada." : "Error al aprobar.";
    }

    if ($accion === 'rechazar') {
        $resultado = $publicacionModel->cambiarEstado($id, 'rechazada');
        $success = $resultado ? "Publicación rechazada." : "Error al rechazar.";
    }
}

// Listar publicaciones pendientes
$pendientes = $publicacionModel->listarPendientes();
include '../app/views/validar.php';
