<?php
session_start();

// Check only for login first
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Use date from session, fallback to today if not set
$attendanceDate = isset($_SESSION['last_attendance_date']) ? $_SESSION['last_attendance_date'] : date("Y-m-d");

// Optional: Remove it after showing once
unset($_SESSION['last_attendance_date']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Marked</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            text-align: center;
            padding: 40px;
            background-color: #f8f9fa;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn {
            margin-top: 20px;
            background: #0d6efd;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>✅ Attendance submitted successfully for <?php echo htmlspecialchars($attendanceDate); ?>!</h2>
        <a href="generate_pdf.php?date=<?php echo urlencode($attendanceDate); ?>" class="btn">📄 Generate PDF</a>
        <br><br>
        <a href="dashboard.php" class="btn" style="background:#198754;">⬅️ Back to Dashboard</a>
    </div>
</body>
</html>
