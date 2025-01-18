<?php
include_once('./inc/header.php');
include_once('./inc/db.php');
?>
<?php
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name =  $_POST['name'];
        $email = $_POST['email'];
        $password =  $_POST['password'];

        if ($name == "" || $email == "" || $password == "") {
            throw new Exception("All Fields are required");
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";

        $conn = getDB();
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "You have sucessfylly registered, Please login NOW!";
            header('refresh: 1; url = ./login.php');
        }
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}

?>

<div class="signup">
    <h1>SIGNUP TO LIBARY</h1>
    <form method="post" class="signup__form">
        <div class="inplbl">
            <label for="name">Name:</label>
            <input type="text" placeholder="enter your name" name="name">
        </div>
        <div class="inplbl">
            <label for="email">Email:</label>
            <input type="email" placeholder="enter your email" name="email">
        </div>
        <div class="inplbl">

            <label for="password">Password:</label>
            <input type="password" placeholder="enter the password" name="password">
        </div>
        <button type="submit" class="btn">Signup</button>
    </form>

    <p>Already have account? <a href="./login.php">Login Here</a></p>
</div>

<?php include_once('./inc/footer.php') ?>