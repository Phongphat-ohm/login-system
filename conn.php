<?php

$servername = 'localhost';
$username = 'root';
$password = ''; // เปลี่ยนเป็นรหัสผ่านของคุณที่ใช้เข้าถึง MySQL
$dbname = 'phongphat';

try {
    $conn = new mysqli($servername, $username, $password, $dbname, 3100);
    // ส่วนอื่น ๆ ของการเชื่อมต่อฐานข้อมูล
} catch (mysqli_sql_exception $e) {
    echo 'เกิดข้อผิดพลาดในการเชื่อมต่อ: ' . $e->getMessage();
}


?>