<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $question = $_POST['question'];
    $formtype_id = $_POST['formtype_id'];
    $question_type = $_POST['question_type'];


    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO question (question, formtype_id, question_type, createdAt) 
            VALUES (:question, :formtype_id, :question_type, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':question', $question);
    $stmt->bindParam(':formtype_id', $formtype_id);
    $stmt->bindParam(':question_type', $question_type);


    if ($stmt->execute()) {
        header('Location: manage_question.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
