<?php
header('Content-Type: application/json');

// Obtener la URL solicitada
$request = $_SERVER['REQUEST_URI'];

// Eliminar prefijos innecesarios (por ejemplo, "/api")
$request = str_replace('/api/', '', $request);

// Dividir la URL en partes
$parts = explode('/', $request);


$resource = isset($parts[0]) ? $parts[0] : null;
$id = isset($parts[1]) ? intval($parts[1]) : null;

// Procesar el recurso solicitado
switch ($resource) {
    case 'producto':
        require_once './data/Producto.php';
        $producto = new Producto();
        
   
        $method = $_SERVER['REQUEST_METHOD'];

        // Leer datos de entrada (para POST o PUT)
        $data = json_decode(file_get_contents("php://input"), true);

        switch ($method) {
            case 'GET':
                if ($id) {
                    $result = $producto->leer($id);
                    echo json_encode($result);
                } else {
                    $result = $producto->leer();
                    echo json_encode($result);
                }
                break;

            case 'POST':
                if (isset($data['id'],$data['nombre'], $data['precio'], $data['cantidad'],$data['stock'])) {
                    $id = $producto->crear($data['id'], $data['nombre'], $data['precio'], $data['cantidad'],$data['stock']);
                    echo json_encode(['message' => 'Producto creado', 'id' => $id]);
                } else {
                    echo json_encode(['error' => 'Datos incompletos']);
                }
                break;

            case 'PUT':
                if ($id && isset($data['nombre'], $data['precio'], $data['cantidad'],$data['stock'])) {
                    $producto->actualizar($id, $data['nombre'], $data['precio'], $data['cantidad'],$data['stock']);
                    echo json_encode(['message' => 'Producto actualizado']);
                } else {
                    echo json_encode(['error' => 'Datos incompletos o ID no proporcionado']);
                }
                break;

            case 'DELETE':
                if ($id) {
                    $producto->eliminar($id);
                    echo json_encode(['message' => 'Producto eliminado']);
                } else {
                    echo json_encode(['error' => 'ID no proporcionado']);
                }
                break;

            default:
                echo json_encode(['error' => 'Método no soportado']);
                break;
        }
        break;

    default:
        echo json_encode(['error' => 'Recurso no encontrado']);
        break;
}
?>
