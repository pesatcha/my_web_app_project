<?php
require 'connect.php';
header('Content-Type: application/json');

$sql_risk = "SELECT a.name, f.nameType, s.score 
            FROM save_data s 
            JOIN acc_user a ON s.acc_id = a.id 
            JOIN form_type f ON s.formtype_id = f.id
            WHERE (f.nameType = 'แบบประเมินความเครียด (ST-5)' AND s.score BETWEEN 10 AND 15)
               OR (f.nameType = 'แบบประเมินซึมเศร้า (9Q)' AND s.score >= 19)
               OR (f.nameType = 'แบบประเมินพลังสุขภาพจิต (RQ)' AND s.score < 55)";

$stmt_risk = $conn->query($sql_risk);
$high_risk_users = $stmt_risk->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($high_risk_users);
?>

