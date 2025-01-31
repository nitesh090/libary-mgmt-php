<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php') ?>
<?php
$id = $_GET['id'];
?>

<form class="takenadd container" method="post">
    <h1>Edit Book Taker</h1>
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
        <button class="bookDeleteBtn">Cancel</button>
        <button class="bookEditBtn">Save</button>
    </div>

</form>

<?php include_once('../inc/libloginfooter.php') ?>