<?php
require '../connect.php';

if (isset($_POST['facultiesId'])) {
    $facultiesId = $_POST['facultiesId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM faculties WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $facultiesId);
    
    if ($stmt->execute()) {
        echo "Faculties deleted successfully.";
    } else {
        echo "Error deleting faculties.";
    }
}
?>
