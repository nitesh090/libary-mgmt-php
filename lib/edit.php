<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php') ?>
<?php

$book_id = $_GET['book_id'];

if (!isset($book_id)) {
    header('Location: ./view.php');
}


try {

    $conn = getDB();
    $sql = "SELECT * FROM book WHERE id='$book_id' ";
    $result = mysqli_query($conn, $sql);
    $oldBook = mysqli_fetch_assoc($result);



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $author = $_POST['author'];
        $publish_date = $_POST['publish_date'];
        $stock = $_POST['stock'];

        if ($name == "" || $author == "" || $publish_date == "" || $stock == "") {
            throw new Exception("All Fields are required");
        }

        $path = '../uploads/';
        $extention = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $file_name = $_POST['name'] . '_' . date('YmdHis') . '.' . $extention;
        $photo = (file_exists($_FILES['photo']['tmp_name'])) ? $file_name : $oldBook['photo'];

        $sql = "UPDATE book SET name='$name', author='$author',publish_date='$publish_date', stock='$stock', photo='$photo' WHERE id='$book_id';";

        $conn = getDB();
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            throw new Exception("Failed to add");
        }

        if ($photo != $oldBook['photo']) {
            move_uploaded_file($_FILES['photo']['tmp_name'], $path . $file_name);
        }

        header('Location: ./view.php');
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}


?>


<form method="post" enctype="multipart/form-data" class="addbook container">
    <h1>Edit Book</h1>
    <div class="addbookImageContainer">
        <?php
        $name = "photo";
        $initial_img = "../uploads/" . $oldBook['photo'];
        $value = "../uploads/" . $oldBook['photo'];
        include('../inc/uploadImg.php');
        ?>
    </div>

    <div class="inplbl">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= htmlentities($oldBook['name']); ?>" placeholder="Book Name">
    </div>
    <div class="inplbl">
        <label for="author">Author:</label>
        <input type="text" name="author" value="<?= htmlentities($oldBook['author']); ?>" placeholder="Book Author">
    </div>
    <div class="inplbl">
        <label for="publish_date">Publish Date:</label>
        <input type="date" name="publish_date" value="<?= htmlentities($oldBook['publish_date']); ?>" placeholder="Book Publish Date">
    </div>
    <div class="inplbl">
        <label for="stock">Stock:</label>
        <input type="number" value="<?= htmlentities($oldBook['stock']); ?>" name="stock" placeholder="Book Stock">
    </div>
    <div class="bookBtnContainer">
        <a href="./view.php" class="bookDeleteBtn">Cancel</a>
        <button class="bookEditBtn" type="submit">Save</button>
    </div>


</form>



<?php include_once('../inc/libloginfooter.php') ?>