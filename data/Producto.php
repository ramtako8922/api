<?php
require_once 'db/ConectionDB.php';

class Producto {
    private $pdo;

    public function __construct() {
        $conexion = new Conexion();
        $this->pdo = $conexion->getPDO();
    }

    // Crear un nuevo producto
    public function crear($id,$nombre,$precio, $cantidad, $stock) {
        $sql = "INSERT INTO productos (producto_id,nombre,precio,cantidad,stock) VALUES (:id, :nombre, :precio, :cantidad, :stock)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id'=>$id, 'nombre' => $nombre, 'precio' => $precio, 'cantidad'=>$cantidad, 'stock' =>$stock]);
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
    public function actualizar($id, $nombre,$cantidad,$precio, $stock, ) {
        $sql = "UPDATE productos SET nombre = :nombre, precio = :precio, cantidad= :cantidad, stock = :stock  WHERE producto_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id, 'nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad, 'stock' => $stock, ]);
    }

    // Eliminar un producto
    public function eliminar($id) {
        $sql = "DELETE FROM productos WHERE producto_id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
