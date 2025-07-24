<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .student-block {
            margin-bottom: 15px;
            background: #f7f7f7;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Mark Attendance</h2>

    <form method="post" action="save_attendance.php">
        <label for="date">Select Date</label>
        <input type="date" name="date" required>

        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='student-block'>";
            echo "<label>{$row['name']} ({$row['roll_number']})</label>";
            echo "<select name='status[{$row['id']}]'>
                    <option value='Present'>Present</option>
                    <option value='Absent'>Absent</option>
                  </select>";
            echo "</div>";
        }
        ?>

        <button type="submit">Submit Attendance</button>
    </form>
</div>

</body>
</html>
