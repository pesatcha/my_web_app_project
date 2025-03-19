<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $nameWorry = $_POST['nameWorry'];
    $nameWorryEng = $_POST['nameWorryEng'];


    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO basic_worry (nameWorry, nameWorryEng, createdAt) 
            VALUES (:nameWorry, :nameWorryEng, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nameWorry', $nameWorry);
    $stmt->bindParam(':nameWorryEng', $nameWorryEng);


    if ($stmt->execute()) {
        header('Location: manage_basic_worry.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
