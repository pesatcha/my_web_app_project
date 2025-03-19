<?php
require '../connect.php';

if (isset($_GET['guidance'])) {
    $guidance = $_GET['guidance'];
    $stmt = $conn->prepare("SELECT id FROM guidance WHERE guidance = :guidance");
    $stmt->bindParam(':guidance', $guidance);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
