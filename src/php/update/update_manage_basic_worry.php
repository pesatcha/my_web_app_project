<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $basicWorryId = $_POST['basicWorryId']; // รับค่า ID จากฟอร์ม
    $nameWorry = $_POST['nameWorry'];
    $nameWorryEng = $_POST['nameWorryEng'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE basic_worry SET nameWorry = ?, nameWorryEng = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nameWorry, $nameWorryEng, $basicWorryId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
