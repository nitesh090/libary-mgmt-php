<?php
include_once('../inc/db.php');

if (!isset($_GET['book_id'])) {
    header('Location: ./view.php');
}
$book_id = $_GET['book_id'];

$conn = getDB();
$sql = "DELETE FROM book WHERE id='$book_id'";
$result = mysqli_query($conn, $sql);

header('Location: ./view.php');
