<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_wellbeing";

try {
    // สร้างการเชื่อมต่อ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // ตั้งค่า PDO error mode เป็น exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "การเชื่อมต่อล้มเหลว: " . $e->getMessage();
}
?>