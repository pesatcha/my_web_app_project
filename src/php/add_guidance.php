<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $guidance = $_POST['guidance'];
    $formtype_id = $_POST['formtype_id'];


    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO guidance (guidance, formtype_id, createdAt) 
            VALUES (:guidance, :formtype_id, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':guidance', $guidance);
    $stmt->bindParam(':formtype_id', $formtype_id);


    if ($stmt->execute()) {
        header('Location: manage_guidance.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
