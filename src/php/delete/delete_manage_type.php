<?php
require '../connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id']; // รับค่า id ที่ต้องการลบ

    if (!$id) {
        echo json_encode(["status" => "error", "message" => "ไม่พบ ID ที่ต้องการลบ"]);
        exit;
    }

    try {
        // ตรวจสอบว่า ID ถูกใช้ในตาราง question หรือ intrepre หรือไม่
        $checkQuery = "
            SELECT 
                (SELECT COUNT(*) FROM question WHERE formtype_id = :id) AS question,
                (SELECT COUNT(*) FROM interpre WHERE formtype_id = :id) AS interpre,
                (SELECT COUNT(*) FROM guidance WHERE formtype_id = :id) AS guidance
        ";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['question'] > 0 || $result['interpre'] > 0 || $result['guidance'] > 0) {
            // ถ้ามีการเชื่อมโยง ให้แจ้งเตือนว่าลบไม่ได้
            echo json_encode(["status" => "error", "message" => "ไม่สามารถลบได้ เนื่องจากข้อมูลถูกใช้งานในเมนูอื่น"]);
        } else {
            // ถ้าไม่มีการเชื่อมโยง ให้ลบได้
            $deleteQuery = "DELETE FROM form_type WHERE id = :id";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "ลบข้อมูลสำเร็จ"]);
            } else {
                echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาดในการลบข้อมูล"]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "คำขอไม่ถูกต้อง"]);
}
?>
