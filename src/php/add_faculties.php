<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $faculties = $_POST['faculties'];
    $phone = $_POST['phone'];


    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO faculties (faculties, phone, createdAt) 
            VALUES (:faculties, :phone, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':faculties', $faculties);
    $stmt->bindParam(':phone', $phone);


    if ($stmt->execute()) {
        header('Location: manage_faculties.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
