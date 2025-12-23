<?php
require_once __DIR__ . '/../models/Publicacion.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/Suscripcion.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
    header("Location: " . BASE_URL . "index.php?page=login&error=login_required");
    exit;
}

$suscripcionModel = new Suscripcion();
$publicacionModel = new Publicacion();

// Si es GET con id → cargar publicación para editar
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $publicacion = $publicacionModel->obtenerPorId($id, $usuario_id);

    if (!$publicacion) {
        $error = "No se encontró la publicación o no pertenece a usted.";
    }

    include __DIR__ . '/../views/publicar.php';
    exit;
}

// Si es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $titulo = $_POST['titulo'] ?? '';
    $categoria_id = $_POST['categoria_id'] ?? null;
    $descripcion = $_POST['descripcion'] ?? '';
    $precio = $_POST['precio'] ?? 0;
    $tipo_operacion = $_POST['tipo_operacion'] ?? 'venta';

    // Manejo de imagen
    $imagen = null;
    if (!empty($_FILES['imagen']['name'])) {
        $nombre = basename($_FILES['imagen']['name']);
        $destino = __DIR__ . '/../../public/images/' . $nombre;

        if (!is_dir(__DIR__ . '/../../public/images')) {
            mkdir(__DIR__ . '/../../public/images', 0777, true);
        }

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destino)) {
            $imagen = $nombre;
        }
    }

    if ($id) {
        // Actualizar publicación existente
        $ok = $publicacionModel->actualizarPublicacion($id, $usuario_id, $titulo, $categoria_id, $descripcion, $precio, $tipo_operacion, $imagen);
        $success = $ok ? "Publicación actualizada correctamente." : "Error al actualizar la publicación.";
    } else {
        //verificar suscripcion activa ANTES de crear publicación
        if (!$suscripcionModel->tieneSuscripcionActiva($usuario_id)) { 
            $error = "Debe tener una suscripción activa para poder publicar.";  
        } else {
            // Crear nueva publicación
            $ok = $publicacionModel->crearPublicacion($usuario_id, $titulo, $categoria_id, $descripcion, $precio, $imagen, $tipo_operacion);
            $success = $ok ? "Publicación creada correctamente. Queda pendiente de validación." : "Error al crear la publicación.";
        }
    }
    include __DIR__ . '/../views/publicar.php';
    exit;
}

// Si es GET sin id → mostrar formulario vacío
include __DIR__ . '/../views/publicar.php';
