<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

require 'connect.php';

$basic_worry_id = $_POST['basic_worry_id'] ?? null;
$faculties_id = $_POST['faculties_id'] ?? null;

if (!$basic_worry_id || !$faculties_id) {
    echo json_encode(["status" => "error", "message" => "กรุณากรอกข้อมูลให้ครบ"]);
    exit();
}

$check_stmt = $conn->prepare("SELECT COUNT(*) FROM match_worry_fac WHERE basic_worry_id = ? AND faculties_id = ?");
$check_stmt->execute([$basic_worry_id, $faculties_id]);
$count = $check_stmt->fetchColumn();

if ($count > 0) {
    echo json_encode(["status" => "error", "message" => "การจับคู่นี้มีอยู่แล้ว"]);
    exit();
}

$insert_stmt = $conn->prepare("INSERT INTO match_worry_fac (basic_worry_id, faculties_id, createdAt) VALUES (?, ?, NOW())");
if ($insert_stmt->execute([$basic_worry_id, $faculties_id])) {
    echo json_encode(["status" => "success", "message" => "เพิ่มข้อมูลสำเร็จ!"]);
} else {
    echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด"]);
}
exit();
?>
