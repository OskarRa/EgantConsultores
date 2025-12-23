<?php
require_once 'Conexion.php';

class Usuario extends Conexion {
    public function registrar($nombre, $fecha_nacimiento, $direccion, $telefono, $correo, $password, $rol_id = 2) {
        $sql = "INSERT INTO usuarios (nombre, fecha_nacimiento, direccion, telefono, correo, password, rol_id)
                VALUES (:nombre, :fecha_nacimiento, :direccion, :telefono, :correo, :password, :rol_id)";
        $stmt = $this->getConexion()->prepare($sql);

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $hash);
        $stmt->bindParam(':rol_id', $rol_id);

        return $stmt->execute();
    }

    public function login($correo, $password) {
        $sql = "SELECT id, nombre, rol_id, correo, password 
                FROM usuarios 
                WHERE correo = :correo";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }
    //Metodos para gestionar usuarios
    public function listarUsuarios() {
        $sql = "SELECT u.id, u.nombre, u.correo, u.fecha_nacimiento, u.direccion, u.telefono, r.nombre AS rol
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                ORDER BY u.id ASC";
        $stmt = $this->getConexion()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT u.id, u.nombre, u.correo, u.fecha_nacimiento, u.direccion, u.telefono, r.nombre AS rol, u.rol_id
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                WHERE u.id = :id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id, $nombre, $correo, $fecha_nacimiento, $direccion, $telefono, $rol_id) {
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, correo = :correo, fecha_nacimiento = :fecha_nacimiento, 
                    direccion = :direccion, telefono = :telefono, rol_id = :rol_id
                WHERE id = :id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
