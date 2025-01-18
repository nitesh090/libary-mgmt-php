<?php

function getDB()
{
    $conn = mysqli_connect('localhost', 'root', '', 'libary_management');
    if (!$conn) {
        die($conn);
    }
    return $conn;
}
