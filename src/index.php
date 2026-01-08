<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อนักศึกษา</title>
    <style>
        body { font-family: 'Sarabun', sans-serif; padding: 20px; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold; 
        }
        tr:hover { background-color: #f9f9f9; }
        .header { margin-bottom: 20px; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
    <h1>รายชื่อนักศึกษาและสาขาวิชา</h1>
</div>

<?php
// 1. ตั้งค่าการเชื่อมต่อฐานข้อมูล
// *** หมายเหตุ: ถ้าใช้ Docker ให้เปลี่ยน 'localhost' เป็นชื่อ Service ใน docker-compose (เช่น 'db') ***
$servername = "db"; 
$username = "user";
$password = "password";
$dbname = "my_database";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("<div style='color:red'>Connection failed: " . $conn->connect_error . "</div>");
}

// ตั้งค่าให้รองรับภาษาไทย
$conn->set_charset("utf8");

// 2. เขียนคำสั่ง SQL (ใช้ JOIN เพื่อดึงชื่อสาขามาแสดงแทนรหัสตัวเลข)
$sql = "SELECT s.student_id, s.full_name, m.major_name 
        FROM students s
        INNER JOIN majors m ON s.major_id = m.major_id
        ORDER BY s.student_id ASC";

$result = $conn->query($sql);
?>

<table>
    <thead>
        <tr>
            <th>รหัสนักศึกษา</th>
            <th>ชื่อ-นามสกุล</th>
            <th>สาขาวิชา</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // วนลูปดึงข้อมูลทีละแถว
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["student_id"] . "</td>";
                echo "<td>" . $row["full_name"] . "</td>";
                echo "<td>" . $row["major_name"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' style='text-align:center'>ไม่พบข้อมูลนักศึกษา</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
// ปิดการเชื่อมต่อ
$conn->close();
?>

</body>
</html>