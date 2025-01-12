<?php include_once('./inc/header.php') ?>
<div class="signup">
    <h1>SIGNUP TO LIBARY</h1>
    <form action="" class="signup__form">
        <div class="inplbl">
            <label for="name">Name:</label>
            <input type="text" placeholder="enter your name" name="name">
        </div>
        <div class="inplbl">
            <label for="email">Email:</label>
            <input type="text" placeholder="enter your email" name="email">
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