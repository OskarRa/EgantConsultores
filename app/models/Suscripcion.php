<?php
require_once 'Conexion.php';

class Suscripcion extends Conexion {

    // Verificar si el usuario tiene una suscripción activa
    public function tieneSuscripcionActiva($usuario_id) {
        $sql = "SELECT 1
                FROM suscripciones s
                JOIN planes p ON p.id = s.plan_id
                WHERE s.usuario_id = :usuario_id
                  AND s.estado = 'activa'
                  AND CURRENT_DATE BETWEEN s.fecha_inicio AND s.fecha_fin
                LIMIT 1";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Obtener la suscripción activa con detalles del plan
    public function obtenerSuscripcionActiva($usuario_id) {
        $sql = "SELECT s.*, p.nombre AS plan_nombre, p.duracion_dias, p.limite_publicaciones
                FROM suscripciones s
                JOIN planes p ON p.id = s.plan_id
                WHERE s.usuario_id = :usuario_id
                  AND s.estado = 'activa'
                  AND CURRENT_DATE BETWEEN s.fecha_inicio AND s.fecha_fin
                ORDER BY s.fecha_fin DESC
                LIMIT 1";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registrar nueva suscripción
    public function crearSuscripcion($usuario_id, $plan_id) {
        if ($this->tieneSuscripcionActiva($usuario_id)) { 
          return false; // Ya tiene una activa, no crear otra 
        }
        $sql = "INSERT INTO suscripciones (usuario_id, plan_id, fecha_inicio, fecha_fin, estado)
                SELECT :usuario_id, :plan_id, CURRENT_DATE, CURRENT_DATE + (p.duracion_dias || ' days')::INTERVAL, 'activa'
                FROM planes p WHERE p.id = :plan_id";
        $stmt = $this->getConexion()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindParam(':plan_id', $plan_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
