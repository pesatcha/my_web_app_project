<?php
require 'connect.php';

$sql = "SELECT s.id, a.name, s.createdAt 
        FROM save_data s 
        JOIN acc_user a ON s.acc_id = a.id 
        WHERE s.viewed = 0 
        ORDER BY s.createdAt DESC";

$stmt = $conn->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>