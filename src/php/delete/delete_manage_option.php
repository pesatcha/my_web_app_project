<?php
require '../connect.php';

if (isset($_POST['optionId'])) {
    $optionId = $_POST['optionId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM option WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $optionId);
    
    if ($stmt->execute()) {
        echo "Option deleted successfully.";
    } else {
        echo "Error deleting option.";
    }
}
?>
