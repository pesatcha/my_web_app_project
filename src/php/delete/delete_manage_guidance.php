<?php
require '../connect.php';

if (isset($_POST['guidanceId'])) {
    $guidanceId = $_POST['guidanceId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM guidance WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $guidanceId);
    
    if ($stmt->execute()) {
        echo "Guidance deleted successfully.";
    } else {
        echo "Error deleting guidance.";
    }
}
?>
