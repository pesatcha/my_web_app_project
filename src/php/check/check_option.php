<?php
require '../connect.php';

if (isset($_GET['option_name'])) {
    $option_name = $_GET['option_name'];
    $stmt = $conn->prepare("SELECT id FROM option WHERE option_name = :option_name");
    $stmt->bindParam(':option_name', $option_name);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
