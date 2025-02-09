<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libary Mgmt</title>
    <link rel="icon" href="../public/img/favicon.ico" />
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: ../login.php');
    }

    if ($_SESSION['role'] == 'student') {
        header('Location: ../stu/student.php');
    }


    ?>
    <nav class="libnav">
        <ul>
            <li><a href="../lib/view.php">Book View</a></li>
            <li><a href="../lib/taken.php">Book Taken</a></li>
        </ul>
        <div class="abtn">
            <a href="../logout.php">Log Out</a>
        </div>
    </nav>