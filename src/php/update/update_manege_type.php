<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nameType = $_POST['nameType'];
    $max_score = $_POST['max_score'];
    $min_score = $_POST['min_score'];
    $nameTypeEng = $_POST['nameTypeEng'];
    $type = $_POST['type'];

    if ($max_score < $min_score) {
        die("Error: ค่า Max ต้องมีค่ามากกว่าค่า Min");
    }

    $sql = "UPDATE form_type SET nameType = ?, max_score = ?, min_score = ?, nameTypeEng = ?, type = ?, updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$nameType, $max_score, $min_score, $nameTypeEng, $type, $id])) {
        echo 'success';
    } else {
        echo 'error';
    }
}

?>
