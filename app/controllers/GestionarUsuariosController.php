<?php
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config.php';

if ($_SESSION['rol'] != 1) {
    $error = "Acceso denegado. Solo administradores pueden gestionar usuarios.";
    include __DIR__ . '/../views/catalogo.php';
    exit;
}

$usuarioModel = new Usuario();
$success = $error = null;

// Acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;
    $id = $_POST['id'] ?? null;

    if ($accion === 'eliminar' && $id) {
        $resultado = $usuarioModel->eliminarUsuario($id);
        $success = $resultado ? "Usuario eliminado correctamente." : "Error al eliminar usuario.";
    }

    if ($accion === 'editar' && $id) {
        // Cargar datos del usuario para mostrar formulario
        $usuarioEditar = $usuarioModel->obtenerUsuarioPorId($id);
    }

    if ($accion === 'guardar' && $id) {
        $nombre = $_POST['nombre'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $direccion = $_POST['direccion'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $rol_id = $_POST['rol_id'] ?? 2;

        $resultado = $usuarioModel->actualizarUsuario(
            $id, $nombre, $correo, $fecha_nacimiento, $direccion, $telefono, $rol_id
        );
        $success = $resultado ? "Usuario actualizado correctamente." : "Error al actualizar usuario.";
    }

}

// Listar todos los usuarios
$usuarios = $usuarioModel->listarUsuarios();
include __DIR__ . '/../views/gestionar_usuarios.php';
