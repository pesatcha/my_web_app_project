<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $optionId = $_POST['optionId']; // รับค่า ID จากฟอร์ม
    $option_name = $_POST['option_name'];
    $formtype_id = $_POST['formtype_id'];
    $score = $_POST['score'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE option SET option_name = ?, formtype_id = ?, score = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$option_name, $formtype_id, $score, $optionId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
