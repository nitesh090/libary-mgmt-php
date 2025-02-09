<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php') ?>
<?php
try {
    $sql = "SELECT id,name FROM user WHERE role='student'";
    $conn = getDB();
    $result = mysqli_query($conn, $sql);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $sql = "SELECT id,name FROM book WHERE stock != '0'";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        print_r($_POST);
        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];
        $taken_date = $_POST['taken_date'];
        $return_date = $_POST['return_date'];
        $has_returned = $_POST['has_returned'];

        if ($student_id == "" || $book_id == "" || $return_date == "" || $has_returned == "") {
            throw new Exception("All Fields are required");
        }
        $sql = "INSERT INTO book_taken_by(student_id,book_id,taken_date,return_date,has_returned) VALUES('$student_id','$book_id','$taken_date','$return_date','$has_returned')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            throw new Exception("Failed to add");
        }
        header('Location: ./taken.php');
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}
?>

<form class="takenadd container" method="post">
    <h1>Add New Book Taker</h1>
    <div class="inplbl">
        <label for="student_id">Student:</label>
        <select name="student_id" id="" value="">
            <option value="" disabled>select student</option>
            <?php
            foreach ($students as $student):
            ?>
                <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="inplbl">
        <label for="book_id">Book:</label>
        <select name="book_id" id="" value="">
            <option value="" disabled>select book</option>
            <?php
            foreach ($books as $book):
            ?>
                <option value="<?= $book['id'] ?>"><?= $book['name'] ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <div class="inplbl">
        <label for="taken_date">Taken Date:</label>
        <input type="date" name="taken_date" placeholder="Taken Date">
    </div>
    <div class="inplbl">
        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" placeholder="Return Date">
    </div>
    <div class="inplbl">
        <label for="has_returned">Has Returned:</label>
        <select name="has_returned" id="">
            <option value="0">Not Returned</option>
            <option value="1">Returned</option>
        </select>

    </div>
    <div class="bookBtnContainer">
        <a href="./taken.php" class="bookDeleteBtn">Cancel</a>
        <button class="bookEditBtn">Save</button>
    </div>

</form>

<?php include_once('../inc/libloginfooter.php') ?>