<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php') ?>
<?php
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "HELLO";
        $name = $_POST['name'];
        $author = $_POST['author'];
        $publish_date = $_POST['publish_date'];
        $stock = $_POST['stock'];

        print_r($_POST);

        if ($name == "" || $author == "" || $publish_date == "" || $stock == "") {
            throw new Exception("All Fields are required");
        }

        $path = '../uploads/';
        $extention = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $file_name = $_POST['name'] . '_' . date('YmdHis') . '.' . $extention;
        $photo = (file_exists($_FILES['photo']['tmp_name'])) ? $file_name : "blank_img.png";

        $sql = "INSERT INTO book (name, author, publish_date, photo, stock) VALUES ('$name', '$author', '$publish_date','$photo', '$stock')";

        $conn = getDB();
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            throw new Exception("Failed to add");
        }

        if ($photo != "blank_img.png") {
            move_uploaded_file($_FILES['photo']['tmp_name'], $path . $file_name);
        }

        header('Location: ./view.php');
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}

?>


<form method="post" enctype="multipart/form-data" class="addbook container">
    <h1>Add Book</h1>
    <div class="addbookImageContainer">
        <?php
        $name = "photo";
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
        <button class="bookEditBtn" type="submit">Save</button>
    </div>


</form>



<?php include_once('../inc/libloginfooter.php') ?>