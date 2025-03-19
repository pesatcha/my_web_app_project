<?php
require '../connect.php';

if (isset($_GET['nameInterpre'])) {
    $nameInterpre = $_GET['nameInterpre'];
    $stmt = $conn->prepare("SELECT id FROM interpre WHERE nameInterpre = :nameInterpre");
    $stmt->bindParam(':nameInterpre', $nameInterpre);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
