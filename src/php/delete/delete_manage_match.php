<?php
require '../connect.php';

if (isset($_POST['matchId'])) {
    $matchId = $_POST['matchId'];

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM match_worry_fac WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $matchId);
    
    if ($stmt->execute()) {
        echo "Option deleted successfully.";
    } else {
        echo "Error deleting question.";
    }
}
?>
