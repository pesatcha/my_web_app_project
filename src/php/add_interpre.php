<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $nameInterpre = $_POST['nameInterpre'];
    $minInterpre = $_POST['min_Interpre'];
    $maxInterpre = $_POST['max_Interpre'];
    $formtype_id = $_POST['formtype_id'];
    $color_Progress = $_POST['color_Progress'];

    // ตรวจสอบค่าของ min และ max
    if ($minInterpre < 0 || $maxInterpre < 0 || $maxInterpre < $minInterpre) {
        echo "Error: Max Interpre must be greater than or equal to Min Interpre.";
        exit; // หยุดการทำงาน
    }

    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO interpre (nameInterpre, min_Interpre, max_Interpre, formtype_id, color_Progress, createdAt) 
            VALUES (:nameInterpre, :minInterpre, :maxInterpre, :formtype_id, :color_Progress, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nameInterpre', $nameInterpre);
    $stmt->bindParam(':minInterpre', $minInterpre);
    $stmt->bindParam(':maxInterpre', $maxInterpre);
    $stmt->bindParam(':formtype_id', $formtype_id);
    $stmt->bindParam(':color_Progress', $color_Progress);

    if ($stmt->execute()) {
        header('Location: manage_interpre.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
