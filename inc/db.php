<?php

function setupDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create database if it doesn't exist
    $dbname = "libary_management";
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        // echo "Database created successfully or already exists.\n";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    // Select the database
    $conn->select_db($dbname);

    // Create user table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS user (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255),
        role ENUM('student', 'librarian') NOT NULL DEFAULT 'student'
    )";
    if ($conn->query($sql) === TRUE) {
        // echo "Table 'user' created successfully or already exists.\n";
    } else {
        echo "Error creating table 'user': " . $conn->error;
    }

    // Create book table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS book (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        author VARCHAR(255),
        publish_date DATE,
        photo VARCHAR(255),
        stock INT
    )";
    if ($conn->query($sql) === TRUE) {
        // echo "Table 'book' created successfully or already exists.\n";
    } else {
        echo "Error creating table 'book': " . $conn->error;
    }

    // Create book_taken_by table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS book_taken_by (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        book_id INT(11) UNSIGNED,
        student_id INT(11) UNSIGNED,
        taken_date DATETIME,
        return_date DATETIME,
        has_returned TINYINT(1) DEFAULT 0,
        FOREIGN KEY (book_id) REFERENCES book(id) ON DELETE CASCADE,
        FOREIGN KEY (student_id) REFERENCES user(id) ON DELETE CASCADE
    )";
    if ($conn->query($sql) === TRUE) {
        // echo "Table 'book_taken_by' created successfully or already exists.\n";
    } else {
        echo "Error creating table 'book_taken_by': " . $conn->error;
    }


    // Check if admin user exists, and insert if not
    $adminEmail = "admin@mail.com";
    $adminPassword = password_hash("admin", PASSWORD_DEFAULT); // Hash the password
    $adminRole = "librarian";

    // Check if the admin user already exists
    $sql = "SELECT id FROM user WHERE email = '$adminEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Insert the admin user
        $sql = "INSERT INTO user (name, email, password, role) VALUES ('Librarian', '$adminEmail', '$adminPassword', '$adminRole')";
        if ($conn->query($sql) === TRUE) {
            // echo "Admin user created successfully.\n";
        } else {
            echo "Error creating admin user: " . $conn->error;
        }
    } else {
        // echo "Admin user already exists.\n";
    }

    // Close connection
    $conn->close();
}

function getDB()
{
    // Check if the setup has already been run in this session
    if (!isset($_SESSION['db_setup_done'])) {
        setupDatabase(); // Run the setup
        $_SESSION['db_setup_done'] = true; // Mark setup as done
    }

    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'libary_management');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}
