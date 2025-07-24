# 📋 PHP Attendance Portal

A simple and professional web-based **Attendance Management System** built with **PHP**, **MySQL**, and **FPDF**. Teachers/Admins can **mark attendance**, **view records by date**, and **download PDFs** of daily attendance reports.

---

## 🚀 Features

- ✅ Admin Login System
- 📅 Mark attendance as **Present / Absent** per student
- 🗓 View attendance records for any selected date
- ⬇️ Download PDF report of any day’s attendance
- 🎨 Clean and professional UI
- 📱 Fully responsive (mobile-friendly)

---

## 🛠 Technologies Used

- PHP (Core)
- MySQL (Database)
- HTML + CSS (Custom Design)
- FPDF Library for PDF generation
- XAMPP (or any local server)

---

## 📂 Folder Structure

attendance_portal/
├── db.php
├── index.php
├── dashboard.php
├── mark_attendance.php
├── view_attendance.php
├── generate_pdf.php
├── fpdf186/
│ └── fpdf.php
├── css/
│ └── (optional custom css files)
├── images/
│ └── login_site.png
│ └── main_portal.png
│ └── saved_records.png
│ └── download_pdf.png
└── README.md


---

## 🖼 Screenshots

## 🔐 Login Page

Teachers must log in using their credentials to access the attendance dashboard.

![Login Page](login%20site.png)

---

## 📊 Main Dashboard

Displays the student list with radio buttons for marking **Present** or **Absent**, date selector, and "Submit Attendance" button.

![Main Portal](main%20porta.png)

---

## 💾 Attendance Records Saved

Once attendance is submitted, records are stored in the database and shown for the selected date.

![Saved Records](saved%20records.png)

---

## 🧾 Download PDF Report

Teachers can download a PDF report for any date, generated using the **FPDF** library.

![Download PDF](download%20pdf.png)


---

## ⚙️ Setup Instructions

1. ✅ Install [XAMPP](https://www.apachefriends.org/) (or use any PHP server)
2. ✅ Place the `attendance_portal` folder in `htdocs`
3. ✅ Start Apache & MySQL from XAMPP Control Panel
4. ✅ Import the following SQL to create the database:

```sql
CREATE DATABASE attendance_db;

USE attendance_db;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    status ENUM('Present', 'Absent') NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id)
);
✅ Update db.php with your MySQL credentials if needed:

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'attendance_db';
$conn = new mysqli($host, $user, $pass, $db);

✅ Download FPDF and place the extracted folder as fpdf186/ inside your project. Use:

require('fpdf186/fpdf.php');

✅ Access the portal via:
http://localhost/attendance_portal/login.php

