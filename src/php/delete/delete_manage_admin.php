<?php
require '../connect.php';

if (isset($_POST['adminId'])) {
    $adminId = $_POST['adminId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM manageadmin WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $adminId);
    
    if ($stmt->execute()) {
        echo "Admin deleted successfully.";
    } else {
        echo "Error deleting admin.";
    }
}
?>
