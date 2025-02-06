<?php
include_once('../inc/db.php');

if (!isset($_GET['taken_id'])) {
    header('Location: ./taken.php');
}

$taken_id = $_GET['taken_id'];

$conn = getDB();
$sql = "DELETE FROM book_taken_by WHERE id='$taken_id'";
$result = mysqli_query($conn, $sql);

header('Location: ./taken.php');
