<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php');

try {
    $conn = getDB();
    $sql = "SELECT * FROM book";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!$result) {
        throw new Exception("Failed to fetch data");
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}

?>
<div class="bookviewheader container">
    <h1>Book View</h1>
    <a href="./add.php" class="addbtn">Add</a>
</div>
<div class="vbook container">

    <?php
    if (count($books) < 1) {
        echo "No Book Found";
    }
    ?>

    <?php foreach ($books as $book): ?>
        <div class="bookCard">
            <img src="../uploads/<?= $book['photo']; ?>" alt="" class="bookCardImg">
            <p class="bookName"><?= $book['name']; ?></p>
            <div class="bookAuthorAndDate">
                <p class="bookAuthor"><?= $book['author']; ?></p>
                <p class="bookDate"><?= $book['publish_date']; ?></p>
            </div>
            <p class="bookStock">Stock: <span><?= $book['stock']; ?></span></p>
            <div class="bookBtnContainer">
                <a href="./edit.php?book_id=<?= $book['id']; ?>" class="btnLink bookEditBtn">edit</a>
                <a href="./delete.php?book_id=<?= $book['id']; ?>" class="btnLink bookDeleteBtn">delete</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<?php include_once('../inc/libloginfooter.php') ?>