<?php
// เชื่อมต่อฐานข้อมูล
require 'connect.php';

// ตรวจสอบว่ามีการส่งข้อมูลฟอร์มมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // แฮชรหัสผ่าน
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // เพิ่มข้อมูลผู้ดูแลระบบใหม่ลงในฐานข้อมูล
    $sql = "INSERT INTO manageadmin (firstname, lastname, username, password, phone, role_id, createdAt) 
            VALUES (:firstname, :lastname, :username, :password, :phone, 
                    (SELECT id FROM role WHERE role = :role), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':role', $role);


    if ($stmt->execute()) {
        header('Location: manage_admin.php');
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->errorInfo()[2];
    }
}
?>
