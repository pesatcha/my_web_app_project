<?php
require '../connect.php';

if (isset($_GET['nameWorry'])) {
    $nameWorry = $_GET['nameWorry'];
    $stmt = $conn->prepare("SELECT id FROM basic_worry WHERE nameWorry = :nameWorry");
    $stmt->bindParam(':nameWorry', $nameWorry);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
