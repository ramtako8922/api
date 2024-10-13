<?php
require_once 'db/Conexion.php';

class Producto {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getPDO();
    }

    // Crear un nuevo producto
    public function crear($nombre, $stock, $precio) {
        $sql = "INSERT INTO productos (nombre, stock, precio) VALUES (:nombre, :stock, :precio)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['nombre' => $nombre, 'stock' => $stock, 'precio' => $precio]);
        return $this->pdo->lastInsertId();
    }

    // Leer un producto o todos los productos
    public function leer($id = null) {
        if ($id) {
            $sql = "SELECT * FROM productos WHERE producto_id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM productos";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // Actualizar un producto
    public function actualizar($id, $nombre, $stock, $precio) {
        $sql = "UPDATE productos SET nombre = :nombre, stock = :stock, precio = :precio WHERE producto_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id, 'nombre' => $nombre, 'stock' => $stock, 'precio' => $precio]);
    }

    // Eliminar un producto
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE producto_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
