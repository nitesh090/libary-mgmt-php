<?php
include_once('./inc/header.php');
include_once('./inc/db.php');
?>

<?php
if (isset($_SESSION['id'])) {
    if ($_SESSION['role'] == 'libarian') {
        header('Location: ./lib/view.php');
    } else {
        header('Location: ./stu/student.php');
    }
}

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password =  $_POST['password'];
        if ($email == "" || $password == "") {
            throw new Exception("All Fields are required");
        }
        $sql = "SELECT * FROM user WHERE email='$email'";
        $conn = getDB();
        $result = mysqli_query($conn, $sql);
        $result = mysqli_fetch_assoc($result);
        if (!$result) {
            throw new Exception("Email or Password is incorrect");
        }

        if (!password_verify($password, $result['password'])) {
            throw new Exception("Email or Password is incorrect");
        }

        $_SESSION = $result;
        unset($_SESSION['password']);

        echo "You have successfully logged IN!";
        if ($result['role'] == 'libarian') {
            // header('Location: ./lib/view.php');
            header('refresh: 1; url = ./lib/view.php');
        } else {
            header('refresh: 1; url = ./stu/student.php');
        }
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}


?>

<div class="login">
    <h1>LOGIN TO LIBARY</h1>
    <form method="post" class="login__form">
        <div class="inplbl">
            <label for="email">Email:</label>
            <input type="text" placeholder="enter your email" name="email">
        </div>
        <div class="inplbl">

            <label for="password">Password:</label>
            <input type="password" placeholder="enter the password" name="password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>

    <p>Don't have account? <a href="./signup.php">Register Here</a></p>
</div>

<?php include_once('./inc/footer.php') ?>