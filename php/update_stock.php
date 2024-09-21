<?php
require_once '../php/connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$ingredientName = $data['ingredientName'];
$change = $data['change'];

// Prepare SQL statement to update stock and remainingStockToday correctly
$stmt = $db->prepare('UPDATE ingredient SET stock = stock + ?, remainingStockToday = remainingStockToday + ? WHERE ingredientName = ?');
$stmt->execute([$change, $change, $ingredientName]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update stock.']);
}
?>
