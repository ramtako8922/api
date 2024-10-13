<?php
header('Content-Type: application/json');
require_once 'data/Producto.php';

$producto = new Producto();

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Leer datos de entrada
$data = json_decode(file_get_contents("php://input"), true);

// Obtener el ID del producto si está presente en la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Procesar la solicitud según el método HTTP
switch ($method) {
    case 'POST':
        // Crear un nuevo producto
        if (isset($data['nombre'], $data['stock'], $data['precio'])) {
            $id = $producto->crear($data['nombre'], $data['stock'], $data['precio']);
            echo json_encode(['message' => 'Producto creado', 'id' => $id]);
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
        break;

    case 'GET':
        // Leer uno o todos los productos
        if ($id) {
            $result = $producto->leer($id);
            echo json_encode($result);
        } else {
            $result = $producto->leer();
            echo json_encode($result);
        }
        break;

    case 'PUT':
        // Actualizar un producto
        if ($id && isset($data['nombre'], $data['stock'], $data['precio'])) {
            $result = $producto->actualizar($id, $data['nombre'], $data['stock'], $data['precio']);
            echo json_encode(['message' => 'Producto actualizado']);
        } else {
            echo json_encode(['error' => 'Datos incompletos o ID no proporcionado']);
        }
        break;

    case 'DELETE':
        // Eliminar un producto
        if ($id) {
            $result = $producto->eliminar($id);
            echo json_encode(['message' => 'Producto eliminado']);
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
        break;

    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
