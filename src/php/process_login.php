<?php
session_start();
require 'connect.php'; // เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "กรุณากรอกชื่อผู้ใช้และรหัสผ่าน";
        header("Location: login.php");
        exit();
    }

    // ค้นหาผู้ใช้ในฐานข้อมูล (ใช้ Named Placeholder)
    $sql = "SELECT id, username, password, role_id FROM manageadmin WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC); // ดึงข้อมูลเป็นอาร์เรย์

    // ตรวจสอบว่าพบผู้ใช้หรือไม่
    if ($user) {
        // ตรวจสอบรหัสผ่าน (กรณีใช้ password_hash)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id'];

            // นำทางไปยังหน้าที่เหมาะสม
            if ($user['role_id'] == 1) {
                header("Location: index.php"); // หน้าผู้ดูแลระบบ
            } elseif ($user['role_id'] == 2) {
                header("Location: index.php"); // หน้านักจิตวิทยา
            } else {
                $_SESSION['error'] = "ไม่มีสิทธิ์เข้าใช้งาน";
                header("Location: login.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $_SESSION['error'] = "ไม่พบบัญชีผู้ใช้งานนี้";
    }

    header("Location: login.php");
    exit();
}
?>
