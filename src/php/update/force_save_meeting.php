<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require '../connect.php'; // เชื่อมต่อฐานข้อมูล
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $saveDataId = isset($_POST['saveDataId']) ? trim($_POST['saveDataId']) : '';
    $accId = isset($_POST['accId']) ? trim($_POST['accId']) : '';
    $meetingDate = isset($_POST['meetingDate']) ? trim($_POST['meetingDate']) : '';
    $startTime = isset($_POST['startTime']) ? trim($_POST['startTime']) : '';
    $endTime = isset($_POST['endTime']) ? trim($_POST['endTime']) : '';
    $meetingDescription = isset($_POST['meetingDescription']) ? trim($_POST['meetingDescription']) : 'นักจิตวิทยาต้องการพบคุณ'; // ตั้งค่าเริ่มต้น

    // แปลงรูปแบบวันที่จาก DD/MM/YYYY เป็น YYYY-MM-DD
    $dateParts = explode('/', $meetingDate);
    $meetingDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];

    if (empty($saveDataId) || empty($accId) || empty($meetingDate) || empty($startTime) || empty($endTime)) {
        echo json_encode(["status" => "error", "message" => "ข้อมูลไม่ครบถ้วน"]);
        exit;
    }

    try {
        // เพิ่มข้อมูลลงใน meetings โดยไม่ตรวจสอบการซ้อนทับ
        $stmtInsert = $conn->prepare("INSERT INTO meetings (acc_id, meeting_date, start_time, end_time, description) VALUES (:acc_id, :meetingDate, :startTime, :endTime, :description)");
        $stmtInsert->execute([
            'acc_id' => $accId,
            'meetingDate' => $meetingDate,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'description' => $meetingDescription
        ]);

        echo json_encode(["status" => "success", "message" => "บันทึกการนัดหมายสำเร็จ"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
}
?>