<?php
require '../connect.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $stmt = $conn->prepare("SELECT id FROM manageadmin WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "exists"; //  ซ้ำ
    } else {
        echo "available"; //  ใช้ได้
    }
}
?>
