<?php
require('fpdf/fpdf.php'); // Make sure fpdf.php is inside 'fpdf/' folder
include 'db.php';

if (!isset($_GET['date'])) {
    die("No date selected.");
}

$date = $_GET['date'];

// Fetch attendance records
$sql = "SELECT a.*, s.name, s.roll_number FROM attendance a 
        JOIN students s ON a.student_id = s.id 
        WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Header Section
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, '📚 XYZ Institute of Technology', 0, 1, 'C');

$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 10, "📅 Attendance Report - " . date("d M Y", strtotime($date)), 0, 1, 'C');
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(0, 123, 255); // Bootstrap blue
$pdf->SetTextColor(255);
$pdf->Cell(10, 10, '#', 1, 0, 'C', true);
$pdf->Cell(70, 10, 'Name', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Roll Number', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Status', 1, 1, 'C', true);

// Table Rows
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0);
$count = 1;
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 10, $count++, 1);
    $pdf->Cell(70, 10, $row['name'], 1);
    $pdf->Cell(50, 10, $row['roll_number'], 1);
    $pdf->Cell(40, 10, $row['status'], 1);
    $pdf->Ln();
}

// Footer
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Generated on: ' . date("d M Y h:i A"), 0, 0, 'L');
$pdf->Cell(0, 10, 'Page ' . $pdf->PageNo(), 0, 0, 'R');

// Output PDF
$pdf->Output('D', "Attendance_$date.pdf");
?>
