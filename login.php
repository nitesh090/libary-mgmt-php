<?php include_once('./inc/header.php') ?>

<div class="login">
    <h1>LOGIN TO LIBARY</h1>
    <form action="" class="login__form">
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