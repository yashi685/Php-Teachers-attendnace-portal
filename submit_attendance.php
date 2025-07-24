<?php
include 'db.php';

if (isset($_POST['attendance_date']) && isset($_POST['attendance'])) {
    $date = $_POST['attendance_date'];
    $attendance = $_POST['attendance'];

    foreach ($attendance as $student_id => $status) {
        $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status)
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE status = ?");
        $stmt->bind_param("isss", $student_id, $date, $status, $status);
        $stmt->execute();
    }

    echo "<script>alert('Attendance submitted successfully!'); window.location.href='dashboard.php';</script>";
}
?>
