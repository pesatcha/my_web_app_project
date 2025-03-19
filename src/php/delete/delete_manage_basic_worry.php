<?php
require '../connect.php';

if (isset($_POST['worryId'])) {
    $worryId = $_POST['worryId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM basic_worry WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $worryId);
    
    if ($stmt->execute()) {
        echo "Worry deleted successfully.";
    } else {
        echo "Error deleting worry.";
    }
}
?>
