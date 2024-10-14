<?php
class Conexion {
    //Colocar las credenciales de la base de datos
    private $host = ''; 
    private $db = '';
    private $user = '';
    private $password = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Error en la conexión: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>
