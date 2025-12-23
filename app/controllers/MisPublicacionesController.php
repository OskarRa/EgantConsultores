<?php
require_once __DIR__ . '/../models/Publicacion.php';
require_once __DIR__ . '/../config.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;

if (!$usuario_id) {
    header("Location: " . BASE_URL . "index.php?page=login&error=login_required");
    exit;
}


$publicacionModel = new Publicacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    $accion = $_POST['accion'] ?? null;

    if ($accion === 'eliminar' && $id) {
        $resultado = $publicacionModel->eliminarPublicacion($id, $usuario_id);
        $success = $resultado ? "Publicación eliminada correctamente." : "Error al eliminar publicación.";
    }

    if ($accion === 'editar' && $id) {
        // Redirigir a publicar con ID (si tienes edición implementada ahí)
        header("Location: " . BASE_URL . "index.php?page=publicar&id=" . $id);
        exit;
    }
}

// Listar publicaciones del usuario
$misPublicaciones = $publicacionModel->listarPorUsuario($usuario_id);
include __DIR__ . '/../views/mis_publicaciones.php';
