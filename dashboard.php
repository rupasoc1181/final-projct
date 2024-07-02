<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$sql_subjects = "SELECT * FROM subjects";
$result_subjects = $conn->query($sql_subjects);

$sql_teachers = "SELECT teachers.name as teacher_name, subjects.name as subject_name 
                 FROM teachers 
                 LEFT JOIN subjects ON teachers.subject_id = subjects.id";
$result_teachers = $conn->query($sql_teachers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Welcome, <?php echo $username; ?>!</h1>

    <h2>Subject Choice List</h2>
    <ul class="list-group">
        <?php while ($row = $result_subjects->fetch_assoc()): ?>
            <li class="list-group-item"><?php echo $row['name']; ?></li>
        <?php endwhile; ?>
    </ul>

    <h2 class="mt-4">Teacher List</h2>
    <ul class="list-group">
        <?php while ($row = $result_teachers->fetch_assoc()): ?>
            <li class="list-group-item"><?php echo $row['teacher_name'] . " - " . $row['subject_name']; ?></li>
        <?php endwhile; ?>
    </ul>

    <a href="logout.php" class="btn btn-danger mt-4">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
