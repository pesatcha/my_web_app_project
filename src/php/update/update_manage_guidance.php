<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guidanceId = $_POST['guidanceId']; // รับค่า ID จากฟอร์ม
    $guidance = $_POST['guidance'];
    $formtype_id = $_POST['formtype_id'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE guidance SET guidance = ?, formtype_id = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$guidance, $formtype_id, $guidanceId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
