<?php
require '../connect.php';

if (isset($_POST['questionId'])) {
    $questionId = $_POST['questionId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM question WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $questionId);
    
    if ($stmt->execute()) {
        echo "Option deleted successfully.";
    } else {
        echo "Error deleting question.";
    }
}
?>
