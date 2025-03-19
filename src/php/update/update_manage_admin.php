<?php
require '../connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminId = $_POST['adminId']; // รับค่า ID จากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE manageadmin SET firstname = ?, lastname = ?, username = ?, phone = ?, role_id = (SELECT id FROM role WHERE role = ?), updatedAt = NOW() 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$firstname, $lastname, $username, $phone, $role, $adminId]);

    echo 'success'; // ส่งกลับข้อความ success
}
?>
