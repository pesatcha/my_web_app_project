<?php
require '../connect.php';

if (isset($_POST['interpreId'])) {
    $interpreId = $_POST['interpreId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM interpre WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $interpreId);
    
    if ($stmt->execute()) {
        echo "Interpre deleted successfully.";
    } else {
        echo "Error deleting interpre.";
    }
}
?>
