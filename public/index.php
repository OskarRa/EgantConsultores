<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../app/config.php';

$page = $_GET['page'] ?? 'catalogo';

switch ($page) {
    case 'login':
        require __DIR__ . '/../app/controllers/LoginController.php';
        break;
    case 'registro':
        require __DIR__ . '/../app/controllers/RegistroController.php';
        break;
    case 'catalogo':
        require __DIR__ . '/../app/controllers/CatalogoController.php';
        break;
    case 'publicar':
        require __DIR__ . '/../app/controllers/PublicarController.php';
        break;
    case 'mis_publicaciones':
        require __DIR__ . '/../app/controllers/MisPublicacionesController.php';
        break;
    case 'validar':
        require __DIR__ . '/../app/controllers/ValidarController.php';
        break;
    case 'gestionar_usuarios':
        require __DIR__ . '/../app/controllers/GestionarUsuariosController.php';
        break;
    case 'suscribirse': 
        require __DIR__ . '/../app/controllers/SuscribirseController.php'; 
        break;
    case 'nosotros':
        require __DIR__ . '/../app/views/nosotros.php';
        break;
    case 'contacto':
        require __DIR__ . '/../app/views/contacto.php';
        break;
    case 'logout':
        session_destroy();
        header("Location: " . BASE_URL . "index.php?page=login");
        exit;
    default:
        echo "Página no encontrada";
}

