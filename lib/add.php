<?php include_once('../inc/libloginheader.php') ?>

<form class="addbook container">
    <h1>Add Book</h1>
    <div class="addbookImageContainer">
        <?php
        $name = "image";
        $required = true;
        include('../inc/uploadImg.php');
        ?>
    </div>

    <div class="inplbl">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Book Name">
    </div>
    <div class="inplbl">
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Book Author">
    </div>
    <div class="inplbl">
        <label for="publish_date">Publish Date:</label>
        <input type="date" name="publish_date" placeholder="Book Publish Date">
    </div>
    <div class="inplbl">
        <label for="stock">Stock:</label>
        <input type="number" name="stock" placeholder="Book Stock">
    </div>
    <div class="bookBtnContainer">
        <button class="bookDeleteBtn">Cancel</button>
        <button class="bookEditBtn">Save</button>
    </div>


</form>



<?php include_once('../inc/libloginfooter.php') ?>