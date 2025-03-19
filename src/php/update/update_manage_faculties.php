<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $facultiesId = $_POST['facultiesId']; // รับค่า ID จากฟอร์ม
    $faculties = $_POST['faculties'];
    $phone = $_POST['phone'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE faculties SET faculties = ?, phone = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$faculties, $phone, $facultiesId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
