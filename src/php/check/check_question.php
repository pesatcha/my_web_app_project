<?php
require '../connect.php';

if (isset($_GET['question'])) {
    $question = $_GET['question'];
    $stmt = $conn->prepare("SELECT id FROM question WHERE question = :question");
    $stmt->bindParam(':question', $question);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
