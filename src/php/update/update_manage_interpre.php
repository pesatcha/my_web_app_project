<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $interpreId = $_POST['interpreId']; // รับค่า ID จากฟอร์ม
    $nameInterpre = $_POST['nameInterpre'];
    $formtype_id = $_POST['formtype_id'];
    $min_Interpre = $_POST['min_Interpre'];
    $max_Interpre = $_POST['max_Interpre'];
    $color_Progress = $_POST['color_Progress'];

    if ($max_Interpre < $min_Interpre) {
        die("Error: ค่า Max ต้องมีค่ามากกว่าค่า Min");
    }
    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE interpre SET nameInterpre = ?, formtype_id = ?, min_Interpre = ?, max_Interpre = ?, color_Progress = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$nameInterpre, $formtype_id, $min_Interpre, $max_Interpre, $color_Progress, $interpreId])) {
        echo 'success'; // ส่งกลับข้อความ success
    } else {
        echo 'error'; // ส่งกลับข้อความ error
    }
}
?>
