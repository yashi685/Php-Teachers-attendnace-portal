<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    foreach ($_POST['attendance'] as $student_id => $status) {
        // Prevent duplicate attendance
        $check = $conn->prepare("SELECT * FROM attendance WHERE student_id = ? AND date = ?");
        $check->bind_param("is", $student_id, $date);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $student_id, $date, $status);
            $stmt->execute();
        }
    }

    // Redirect or generate PDF
    header("Location: attendnace_success.php");
    exit();
}
?>
