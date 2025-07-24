<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch students
$students = $conn->query("SELECT * FROM students ORDER BY name");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f0f2f5;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #343a40;
            color: white;
            padding: 15px;
            border-radius: 6px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .photo-frame {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            overflow: hidden;
        }
        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .user-details {
            display: flex;
            flex-direction: column;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }
        h2 {
            margin-top: 20px;
        }
        form {
            margin-top: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }
        .view-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 16px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 15px;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <div class="user-info">
        <div class="photo-frame">
            <img src="default_profile.png" alt="User Photo"> <!-- Replace with actual user image path -->
        </div>
        <div class="user-details">
            <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong>
            <span>Role: Teacher</span>
        </div>
    </div>
    <div>
        <a class="logout-btn" href="logout.php">Logout</a>
    </div>
</div>

<h2>📋 Mark Attendance</h2>

<form action="submit_attendance.php" method="post">
    <label>Select Date:</label>
    <input type="date" name="attendance_date" required value="<?php echo date('Y-m-d'); ?>">

    <table>
        <tr>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Present</th>
            <th>Absent</th>
        </tr>
        <?php while ($row = $students->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['roll_number']); ?></td>
                <td><input type="radio" name="attendance[<?php echo $row['id']; ?>]" value="Present" required></td>
                <td><input type="radio" name="attendance[<?php echo $row['id']; ?>]" value="Absent" required></td>
            </tr>
        <?php } ?>
    </table>

    <button type="submit" name="submit" class="submit-btn">✅ Submit Attendance</button>
</form>

<a href="view_attendance.php" class="view-btn">📄 View Attendance Records</a>

</body>
</html>
