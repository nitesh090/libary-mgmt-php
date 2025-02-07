<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php');

if (!isset($_GET['taken_id'])) {
    header('Location: ./taken.php');
}

$taken_id = $_GET['taken_id'];

try {
    $sql = "SELECT id,name FROM user WHERE role='student'";
    $conn = getDB();
    $result = mysqli_query($conn, $sql);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = "SELECT id,name FROM book WHERE stock != '0'";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $sql = "SELECT * FROM book_taken_by WHERE id='$taken_id'";
    $result = mysqli_query($conn, $sql);
    $books_taken_by = mysqli_fetch_assoc($result);
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
    exit;
}

try {
    if (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];
        $taken_date = $_POST['taken_date'];
        $return_date = $_POST['return_date'];
        $has_returned = $_POST['has_returned'];

        $sql = "UPDATE book_taken_by SET student_id='$student_id', book_id='$book_id', taken_date='$taken_date', return_date='$return_date', has_returned='$has_returned' WHERE id='$taken_id' ";
        $conn = getDB();
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            throw new Exception('failed to update');
        }
        header('Location: ./taken.php');
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}

?>

<form class="takenadd container" method="post">
    <h1>Edit Book Taker</h1>
    <div class="inplbl">
        <label for="student_id">Student:</label>
        <select name="student_id" id="student_id">
            <option value="" disabled>select student</option>
            <?php
            foreach ($students as $student):
            ?>
                <option value="<?= $student['id'] ?>" <?= $student['id'] == $books_taken_by['student_id'] ? 'selected' : '' ?>><?= $student['name'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="inplbl">
        <label for="book_id">Book:</label>
        <select name="book_id" id="book_id">
            <option value="" disabled>select book</option>
            <?php
            foreach ($books as $book):
            ?>
                <option value="<?= $book['id'] ?>" <?= $book['id'] == $books_taken_by['book_id'] ? 'selected' : '' ?>><?= $book['name'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="inplbl">
        <label for="taken_date">Taken Date:</label>
        <input type="date" name="taken_date" placeholder="Taken Date" value="<?= str_split($books_taken_by['taken_date'], 10)[0]  ?>">
    </div>
    <div class="inplbl">
        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" placeholder="Return Date" value="<?= str_split($books_taken_by['return_date'], 10)[0]  ?>">
    </div>
    <div class="inplbl">
        <label for="has_returned">Has Returned:</label>
        <select name="has_returned" id="">
            <option value="0" <?= "0" == $books_taken_by['has_returned'] ? 'selected' : '' ?>>Not Returned</option>
            <option value="1" <?= "1" == $books_taken_by['has_returned'] ? 'selected' : '' ?>>Returned</option>
        </select>

    </div>
    <div class="bookBtnContainer">
        <a href="./taken.php" class="bookDeleteBtn">Cancel</a>
        <button class="bookEditBtn">Save</button>
    </div>

</form>

<?php include_once('../inc/libloginfooter.php') ?>