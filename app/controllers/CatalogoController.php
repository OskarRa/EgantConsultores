<?php
require_once '../app/models/Publicacion.php';

class CatalogoController {
    public function mostrar() {
        
        $publicacionModel = new Publicacion();

        // Capturar parámetros GET
        $tipo = $_GET['tipo'] ?? null;              // categoría: inmuebles, vehículos, general
        $busqueda = $_GET['busqueda'] ?? null;      // texto de búsqueda
        $operacion = $_GET['operacion'] ?? 'ambos'; // venta, alquiler, ambos
        $orden = $_GET['orden'] ?? 'asc';           // asc o desc

        // Lógica de selección
        if ($busqueda) { 
            // Si hay texto de búsqueda
            $publicaciones = $publicacionModel->buscarPublicaciones($busqueda); 
        } else { 
            // Si no hay búsqueda, usar filtros completos
            $publicaciones = $publicacionModel->listarCatalogo($tipo, $operacion, $orden); 
        }

        $rol = $_SESSION['rol'] ?? null;

        // Pasar datos a la vista
        include __DIR__ . '/../views/catalogo.php';
    }
}

// Si se llama directamente al archivo, ejecutamos el método
$controller = new CatalogoController();
$controller->mostrar();

