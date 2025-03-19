<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matchId = $_POST['matchId']; // รับค่า ID จากฟอร์ม
    $basic_worry_id = $_POST['basic_worry_id'];
    $faculties_id = $_POST['faculties_id'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE match_worry_fac SET basic_worry_id = ?, faculties_id = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$basic_worry_id, $faculties_id, $matchId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
