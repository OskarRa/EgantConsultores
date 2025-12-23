<?php
require_once '../app/models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $usuarioModel = new Usuario();
    $usuario = $usuarioModel->login($correo, $contraseña);

    if ($usuario) {
        // Guardar datos en sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['rol'] = $usuario['rol_id'];
        $_SESSION['nombre'] = $usuario['nombre']; 

        // Redirigir según rol
        if ($_SESSION['rol'] == 1) {
            header("Location: ../public/index.php?page=validar");
        } elseif ($_SESSION['rol'] == 2) {
            header("Location: ../public/index.php?page=catalogo");
        } else {
            header("Location: ../public/index.php?page=catalogo");
        }
        exit;
    } else {
        $error = "Credenciales incorrectas";
        include '../app/views/login.php';
    }
} else {
    // Si es GET, simplemente mostrar el formulario
    include '../app/views/login.php';
}

