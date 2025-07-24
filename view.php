<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Records</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f4f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .btn-download {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-download a {
            text-decoration: none;
        }

        .btn-download button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-download button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #eaf1ff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Attendance Records</h2>

    <div class="btn-download">
        <a href="generate_pdf.php" target="_blank">
            <button>Download Report as PDF</button>
        </a>
    </div>

    <table>
        <tr>
            <th>Date</th>
            <th>Student Name</th>
            <th>Roll No</th>
            <th>Status</th>
        </tr>

        <?php
        $sql = "SELECT attendance.date, students.name, students.roll_number, attendance.status 
                FROM attendance 
                JOIN students ON attendance.student_id = students.id 
                ORDER BY date DESC";

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['date']}</td>
                <td>{$row['name']}</td>
                <td>{$row['roll_number']}</td>
                <td>{$row['status']}</td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
