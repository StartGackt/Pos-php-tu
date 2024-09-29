<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Inven";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // ตรวจสอบการเชื่อมต่อ
    if ($conn) {
        // Connection successful
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้: ' . $e->getMessage()]);
    exit;
}
?>
