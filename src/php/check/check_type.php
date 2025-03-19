<?php
require '../connect.php';

if (isset($_GET['nameType'])) {
    $nameType = $_GET['nameType'];
    $stmt = $conn->prepare("SELECT id FROM form_type WHERE nameType = :nameType");
    $stmt->bindParam(':nameType', $nameType);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
