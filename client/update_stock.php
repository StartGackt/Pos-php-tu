<?php
header('Content-Type: application/json');

// Connect to the database
$connectFile = $_SERVER['DOCUMENT_ROOT'] . '/Pos-php-tu/connect.php';
if (file_exists($connectFile)) {
    include $connectFile;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Connection file not found']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $cartItems = $data['cartItems'];

    try {
        $conn->beginTransaction();

        foreach ($cartItems as $item) {
            $stmt = $conn->prepare("SELECT ingredient1, ingredient2, ingredient3, ingredient4 FROM menu WHERE menu_name = ?");
            $stmt->execute([$item['name']]);
            $ingredients = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach ($ingredients as $ingredient) {
                if ($ingredient) {
                    $stmt = $conn->prepare("UPDATE ingredients SET stock = stock - 1, used_today = used_today + 1, remaining_stock = stock - used_today WHERE id = ?");
                    $stmt->execute([$ingredient]);
                }
            }
        }

        $conn->commit();
        echo json_encode(['status' => 'success']);
    } catch (PDOException $e) {
        $conn->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
