<?php
// header.php
// Asegúrate de definir BASE_URL antes de incluir este archivo, p.ej. en config.php
// Opcional: $pageTitle = 'Título de la página'; si no está definido se usa un valor por defecto
$pageTitle = $pageTitle ?? 'Egant Consultores';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Tus estilos -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>
<body>
    <!-- Navbar principal -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php?page=catalogo">Egant Consultores</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Alternar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=catalogo">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Layout con sidebar (usa la grid de Bootstrap) -->
    <div class="container-fluid">
        <div class="row g-0">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 border-end p-3 sidebar-lateral">
                <div class="mb-3">
                    <?php if (!empty($_SESSION['usuario_id'])): ?>
                        <p class="fw-bold user-tag">👤 <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario'); ?></p>
                    <?php else: ?>
                        <p class="fw-bold user-tag">👤 Visitante</p>
                    <?php endif; ?>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=catalogo&tipo=inmuebles">Inmuebles</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=catalogo&tipo=vehiculos">Vehículos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=catalogo&tipo=general">General</a></li>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=publicar">Publicar</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=mis_publicaciones">Mis publicaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=suscribirse">Suscribirse</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="<?php echo BASE_URL; ?>index.php?page=logout">Cerrar sesión</a></li>
                    <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 1): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=publicar">Publicar</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=mis_publicaciones">Mis publicaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=suscribirse">Suscribirse</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=validar">Validar publicaciones</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=gestionar_usuarios">Gestionar usuarios</a></li>
                        <li class="nav-item"><a class="nav-link text-danger" href="<?php echo BASE_URL; ?>index.php?page=logout">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=login">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php?page=registro">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </aside>

            <!-- Contenido principal: se abre aquí y se cierra en footer.php -->
            <main class="col-md-9 col-lg-10 p-4 main-content">
