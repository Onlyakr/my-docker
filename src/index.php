<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อน้องๆ นักศึกษา (✿◠‿◠)</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Itim', cursive;
            background-color: #ffe8f0;
            background-image: radial-gradient(#ffc2d4 2px, transparent 2px);
            background-size: 30px 30px;
            color: #6d6875;
            padding: 30px;
            margin: 0;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 800px;
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 10px 25px rgba(255, 175, 204, 0.4);
            border: 5px solid #fff;
            position: relative;
        }

        h1 {
            text-align: center;
            color: #ff8fab;
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 0px #fff, 4px 4px 0px #bde0fe;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        thead th {
            background-color: #ffafcc;
            color: white;
            padding: 15px;
            font-size: 1.2rem;
            border: none;
        }
        
        thead th:first-child { border-radius: 20px 0 0 20px; }
        thead th:last-child { border-radius: 0 20px 20px 0; }

        tbody tr {
            background-color: #f0f8ff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        tbody tr:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(162, 210, 255, 0.4);
            background-color: #e2f0fb;
            cursor: pointer;
        }

        td {
            padding: 15px;
            border: none;
            text-align: center;
            font-size: 1.1rem;
        }

        tbody td:first-child { 
            border-radius: 20px 0 0 20px; 
            color: #ff8fab;
            font-weight: bold;
        }
        tbody td:last-child { 
            border-radius: 0 20px 20px 0;
            color: #7b2cbf;
        }

        /* ตกแต่งป้ายสาขาวิชา */
        .major-badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #cdb4db;
            color: white;
            border-radius: 50px;
            font-size: 0.9rem;
            box-shadow: 2px 2px 0px #a2d2ff;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #ffc8dd;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>รายชื่อนักศึกษา</h1>

    <?php
    $servername = "db"; 
    $username = "user";
    $password = "password";
    $dbname = "my_database";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("<div style='text-align:center; color:#ff5c8a;'>งืออ.. เชื่อมต่อฐานข้อมูลไม่ได้ (T_T)<br>" . $conn->connect_error . "</div>");
    }
    $conn->set_charset("utf8");

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
                <th>ชื่อ-สกุล</th>
                <th>สาขาวิชา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td style='text-align:left; padding-left:30px;'>" . $row["full_name"] . "</td>";
                    echo "<td><span class='major-badge'>" . $row["major_name"] . "</span></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='empty-state'>
                    (｡•́︿•̀｡) <br> ยังไม่มีข้อมูลนักศึกษา
                </td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php $conn->close(); ?>
</div>

</body>
</html>