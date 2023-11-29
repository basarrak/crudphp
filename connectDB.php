<?php
$servername = "localhost"; // หรือ IP address ของ MySQL server
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = ""; // รหัสผ่าน MySQL
$dbname = "php_crud_tutorial"; // ชื่อฐานข้อมูล
// $db_connect();
// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 
}
?>
