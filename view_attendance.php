<?php
include 'db.php';

$date = $_GET['date'] ?? date('Y-m-d');

$sql = "SELECT a.*, s.name, s.roll_number 
        FROM attendance a 
        JOIN students s ON a.student_id = s.id 
        WHERE date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Records</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f4f8;
      padding: 40px 20px;
    }

    .container {
      max-width: 960px;
      margin: auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    form {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    input[type="date"] {
      padding: 10px 14px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #fff;
    }

    button {
      padding: 10px 18px;
      font-size: 16px;
      background-color: #0066cc;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .record-card {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 15px;
      padding: 20px;
      background-color: #f9fafb;
      margin-bottom: 12px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .record-card h4 {
      font-weight: 600;
      color: #333;
    }

    .status {
      font-weight: 600;
      text-align: center;
      padding: 8px 14px;
      border-radius: 6px;
    }

    .present {
      background-color: #d1f3e0;
      color: #1e7e34;
    }

    .absent {
      background-color: #f8d7da;
      color: #842029;
    }

    .footer {
      margin-top: 20px;
      text-align: right;
    }

    .footer a {
      text-decoration: none;
      color: #0066cc;
      font-weight: bold;
    }

    /* Back to Dashboard button style */
    .back-btn-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .back-btn {
      display: inline-block;
      padding: 10px 18px;
      background-color: #0066cc;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .back-btn:hover {
      background-color: #004999;
    }

    @media screen and (max-width: 700px) {
      .record-card {
        grid-template-columns: 1fr;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📊 Attendance Records</h2>

    <form method="get">
      <input type="date" name="date" value="<?= htmlspecialchars($date) ?>" required>
      <button type="submit">🔍 View</button>
    </form>

    <?php
    $count = 0;
    while ($row = $result->fetch_assoc()) {
      $statusClass = strtolower($row['status']) === 'present' ? 'present' : 'absent';
      echo "<div class='record-card'>
              <h4>👤 Name: {$row['name']}</h4>
              <h4>🧾 Roll No: {$row['roll_number']}</h4>
              <div class='status $statusClass'>{$row['status']}</div>
            </div>";
      $count++;
    }

    if ($count === 0) {
      echo "<p style='text-align:center;'>No records found for selected date.</p>";
    }
    ?>

    <div class="back-btn-container">
      <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>

    <div class="footer">
      <a href="generate_pdf.php?date=<?= urlencode($date) ?>" target="_blank">⬇️ Download PDF</a>
    </div>
  </div>
</body>
</html>
