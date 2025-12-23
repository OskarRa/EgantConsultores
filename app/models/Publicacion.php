<?php
require_once 'Conexion.php';

class Publicacion extends Conexion {

    // Catálogo público: todas las aprobadas
    public function listarPublicaciones() {
        $sql = "SELECT * FROM publicaciones WHERE estado = 'aprobada' ORDER BY id DESC";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Catálogo filtrado por tipo (inmuebles, vehiculos, general)
    public function listarPorTipo($tipo) {
        // Mapear texto a id de categoría
        $map = [
            'inmuebles' => 1,
            'vehiculos' => 2,
            'general'   => 3
        ];

        if (!isset($map[$tipo])) {
            return []; // categoría inválida
        }

        $categoria_id = $map[$tipo];

        $sql = "SELECT * FROM publicaciones WHERE categoria_id = :categoria_id AND estado = 'aprobada'";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //Busqueda por tipo_operacion, categoria y orden por precio
    public function listarCatalogo($tipo = null, $operacion = 'ambos', $orden = 'asc') {
        $sql = "SELECT * FROM publicaciones WHERE estado = 'aprobada'";

        // Mapear texto a ID
        $map = [
            'inmuebles' => 1,
            'vehiculos' => 2,
            'general'   => 3
        ];

        if ($tipo && isset($map[$tipo])) {
            $sql .= " AND categoria_id = :categoria_id";
        }

        if ($operacion !== 'ambos') {
            $sql .= " AND tipo_operacion = :tipo_operacion";
        }

        $sql .= $orden === 'desc' ? " ORDER BY precio DESC" : " ORDER BY precio ASC";

        $stmt = $this->getConexion()->prepare($sql);

        if ($tipo && isset($map[$tipo])) {
            $stmt->bindParam(':categoria_id', $map[$tipo], PDO::PARAM_INT);
        }
        if ($operacion !== 'ambos') {
            $stmt->bindParam(':tipo_operacion', $operacion);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Búsqueda por texto en título o descripción
    public function buscarPublicaciones($texto) {
        $sql = "SELECT * FROM publicaciones 
                WHERE estado = 'aprobada' 
                AND (titulo LIKE :texto OR descripcion LIKE :texto)
                ORDER BY id DESC";
        $stmt = $this->getConexion()->prepare($sql);
        $like = "%".$texto."%";
        $stmt->bindParam(':texto', $like);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear nueva publicación
    public function crearPublicacion($usuario_id, $titulo, $categoria_id, $descripcion, $precio, $imagen, $tipo_operacion) {
        // Verificar suscripción activa 
        $suscripcion = new Suscripcion(); 
        if (!$suscripcion->tieneSuscripcionActiva($usuario_id)) {
            throw new Exception("El usuario no tiene una suscripción activa para publicar."); 
        }

        $sql = "INSERT INTO publicaciones 
                (usuario_id, titulo, categoria_id, descripcion, precio, imagen, tipo_operacion, estado)
                VALUES (:usuario_id, :titulo, :categoria_id, :descripcion, :precio, :imagen, :tipo_operacion, 'pendiente')";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);
        $stmt->bindParam(':tipo_operacion', $tipo_operacion);
        return $stmt->execute();
    }

    // Mis publicaciones
    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT * FROM publicaciones WHERE usuario_id = :usuario_id ORDER BY id DESC";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar publicación
    public function eliminarPublicacion($id, $usuario_id) {
        $sql = "DELETE FROM publicaciones WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario_id', $usuario_id);
        return $stmt->execute();
    }

    // Publicaciones pendientes (para validar)
    public function listarPendientes() {
        $sql = "SELECT * FROM publicaciones WHERE estado = 'pendiente' ORDER BY id ASC";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cambiar estado (aprobar/rechazar)
    public function cambiarEstado($id, $nuevoEstado) {
        $sql = "UPDATE publicaciones SET estado = :estado WHERE id = :id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':estado', $nuevoEstado);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    //editar publicaciones
    public function obtenerPorId($id, $usuario_id) {
        $sql = "SELECT * FROM publicaciones WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPublicacion($id, $usuario_id, $titulo, $categoria_id, $descripcion, $precio, $tipo_operacion, $imagen = null) {
        $sql = "UPDATE publicaciones 
                SET titulo = :titulo, 
                    categoria_id = :categoria_id, 
                    descripcion = :descripcion, 
                    precio = :precio, 
                    tipo_operacion = :tipo_operacion"
                . ($imagen ? ", imagen = :imagen" : "") . 
                " WHERE id = :id AND usuario_id = :usuario_id";

        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':categoria_id', $categoria_id);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':tipo_operacion', $tipo_operacion);
        if ($imagen) {
            $stmt->bindParam(':imagen', $imagen);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}

