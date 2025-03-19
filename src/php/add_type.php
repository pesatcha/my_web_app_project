<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nameType = $_POST['nameType'];
    $nameTypeEng = $_POST['nameTypeEng'];
    $max_score = $_POST['max_score'];
    $min_score = $_POST['min_score'];
    $type = $_POST['type'];

    if ($max_score < $min_score) {
        die("Error: Max Score must be greater than or equal to Min Score.");
    }

    $sql = "INSERT INTO form_type (nameType, nameTypeEng, max_score, min_score, type, createdAt) 
            VALUES (:nameType, :nameTypeEng, :max_score, :min_score, :type, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nameType', $nameType);
    $stmt->bindParam(':nameTypeEng', $nameTypeEng);
    $stmt->bindParam(':max_score', $max_score);
    $stmt->bindParam(':min_score', $min_score);
    $stmt->bindParam(':type', $type);

    if ($stmt->execute()) {
        header('Location: manage_type.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}

?>
