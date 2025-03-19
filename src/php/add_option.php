<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $option_name = $_POST['option_name'];
    $formtype_id = $_POST['formtype_id'];
    $score = $_POST['score'];


    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO option (option_name, formtype_id, score, createdAt) 
            VALUES (:option_name, :formtype_id, :score, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':option_name', $option_name);
    $stmt->bindParam(':formtype_id', $formtype_id);
    $stmt->bindParam(':score', $score);


    if ($stmt->execute()) {
        header('Location: manage_option.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
