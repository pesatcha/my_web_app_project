<?php
require '../connect.php';

if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM acc_user WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $user_id);
    
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user.";
    }
}
?>


