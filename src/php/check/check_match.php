<?php
require '../connect.php';

$basic_worry_id = $_GET['basic_worry_id'] ?? null;
$faculties_id = $_GET['faculties_id'] ?? null;

if (!$basic_worry_id || !$faculties_id) {
    echo "error";
    exit();
}

// ตรวจสอบว่ามีการจับคู่ซ้ำหรือไม่
$check_stmt = $conn->prepare("SELECT COUNT(*) FROM match_worry_fac WHERE basic_worry_id = ? AND faculties_id = ?");
$check_stmt->execute([$basic_worry_id, $faculties_id]);
$count = $check_stmt->fetchColumn();

if ($count > 0) {
    echo "exists"; // แจ้งว่ามีข้อมูลซ้ำ
} else {
    echo "not_exists"; // แจ้งว่าสามารถเพิ่มข้อมูลได้
}
?>
