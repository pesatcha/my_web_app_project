<?php
require '../connect.php';

if (isset($_GET['faculties'])) {
    $faculties = $_GET['faculties'];
    $stmt = $conn->prepare("SELECT id FROM faculties WHERE faculties = :faculties");
    $stmt->bindParam(':faculties', $faculties);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
