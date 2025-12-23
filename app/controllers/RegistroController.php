<?php
require_once '../app/models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'] ?? '';
    $terminos = $_POST['terminos'] ?? null;

    // Validaciones básicas
    if ($contraseña !== $confirmar_contraseña) {
        $error = "Las contraseñas no coinciden";
        include '../app/views/registro.php';
        exit;
    }

    if (!$terminos) {
        $error = "Debes aceptar los términos y condiciones";
        include '../app/views/registro.php';
        exit;
    }

    $usuarioModel = new Usuario();
    $resultado = $usuarioModel->registrar(
        $nombre,
        $fecha_nacimiento,
        $direccion,
        $telefono,
        $correo,
        $contraseña,
        2 // rol por defecto = usuario
    );

    if ($resultado) {
        // Redirigir al login con mensaje de éxito
        header("Location: ../public/index.php?page=login&success=1");
        exit;
    } else {
        $error = "Error al registrar usuario";
        include '../app/views/registro.php';
    }
} else {
    // Si es GET, simplemente mostrar el formulario
    include '../app/views/registro.php';
}