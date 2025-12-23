<?php
class Conexion {
    private $host = "localhost";
    private $port = "5432";
    private $dbname = "egant_db";
    private $user = "postgres";
    private $password = "12345678*";
    protected $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO(
                "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                $this->user,
                $this->password
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
