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

    // ตรวจสอบว่าวันที่เลือกเป็นวันที่ในอดีตหรือไม่
    $today = date("Y-m-d"); // ได้รูปแบบ YYYY-MM-DD
    if ($meetingDate < $today) {
        echo json_encode(["status" => "error", "message" => "ไม่สามารถนัดพบวันที่ผ่านมาแล้ว"]);
        exit;
    }

    // ตรวจสอบว่าเวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด
    if ($startTime >= $endTime) {
        echo json_encode(["status" => "error", "message" => "เวลาเริ่มต้นต้องน้อยกว่าเวลาสิ้นสุด"]);
        exit;
    }

    try {
        // ตรวจสอบว่ามีการนัดหมายในวันและเวลาที่เลือกแล้วหรือไม่
        $stmtCheckMeeting = $conn->prepare("SELECT * FROM meetings WHERE acc_id = :acc_id AND meeting_date = :meetingDate AND ((start_time < :endTime AND end_time > :startTime))");
        $stmtCheckMeeting->execute([
            'acc_id' => $accId,
            'meetingDate' => $meetingDate,
            'startTime' => $startTime,
            'endTime' => $endTime
        ]);

        $conflictingMeetings = [];
        if ($stmtCheckMeeting->rowCount() > 0) {
            $conflictingMeetings = $stmtCheckMeeting->fetchAll(PDO::FETCH_ASSOC);
        }

        // ส่งข้อมูลการซ้อนทับกลับไปยังผู้ใช้
        echo json_encode([
            "status" => "conflict",
            "message" => "มีการนัดหมายที่ซ้อนทับกัน",
            "conflicts" => $conflictingMeetings
        ]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
}
?>