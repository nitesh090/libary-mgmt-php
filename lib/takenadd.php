<?php include_once('../inc/libloginheader.php') ?>
<form class="takenadd container">
    <h1>Add New Book Taker</h1>
    <div class="inplbl">
        <label for="s.name">Student Name:</label>
        <input type="text" name="s.name" placeholder="Student Name">
    </div>
    <div class="inplbl">
        <label for="s.book">Book Name:</label>
        <input type="text" name="s.book" placeholder="Book Name">
    </div>
    <div class="inplbl">
        <label for="author">Author:</label>
        <input type="text" name="author" placeholder="Author">
    </div>
    <div class="inplbl">
        <label for="taken_date">Taken Date:</label>
        <input type="date" name="taken_date" placeholder="Taken Date">
    </div>
    <div class="inplbl">
        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" placeholder="Return Date">
    </div>
    <div class="bookBtnContainer">
        <button class="bookDeleteBtn">Cancel</button>
        <button class="bookEditBtn">Save</button>
    </div>

</form>

<?php include_once('../inc/libloginfooter.php') ?>