<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $questionId = $_POST['questionId']; // รับค่า ID จากฟอร์ม
    $question = $_POST['question'];
    $formtype_id = $_POST['formtype_id'];
    $question_type = $_POST['question_type'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE question SET question = ?, formtype_id = ?, question_type = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$question, $formtype_id, $question_type, $questionId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
