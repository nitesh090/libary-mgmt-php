<?php include_once('../inc/libloginheader.php') ?>
<section class="container">
    <header class="takenheader">
        <div class="tabs">
            <a class="tab activeTab">All</a>
            <a class="tab">Return</a>
            <a class="tab">Not Return</a>
        </div>

        <a href="#" class="addtakenbtn">Add New +</a>
    </header>
    <table class="takentabel">
        <tr>
            <th>Student Name</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Taken Date</th>
            <th>Time</th>
            <th>Edit</th>
        </tr>
        <tr>
            <td>Niku</td>
            <td>Book Name</td>
            <td>Author</td>
            <td>Taken Date</td>
            <td>Time</td>
            <td>
                <div class="bookBtnContainer">
                    <button class="bookDeleteBtn">Remove</button>
                    <button class="bookEditBtn">Edit</button>
                </div>

            </td>
        </tr>
    </table>
</section>

<?php include_once('../inc/libloginfooter.php') ?>