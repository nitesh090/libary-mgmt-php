<?php include_once('../inc/libloginheader.php');
include_once('../inc/db.php') ?>;
<?php

$returned = -1;

if (isset($_GET['returned'])) {
    if ($_GET['returned'] == '0') {
        $returned = 0;
    } elseif ($_GET['returned'] == '1') {
        $returned = 1;
    } else {
        $returned = -1;
    }
}



try {
    $conn = getDB();
    $sql = "SELECT bt.id, bt.has_returned, bt.taken_date, bt.return_date, b.name as bookName, u.name as studentName FROM `book_taken_by` bt JOIN book b ON bt.book_id=b.id JOIN user u ON bt.student_id=u.id";
    if ($returned != -1) {
        $sql .= " where bt.has_returned = '$returned'";
    }
    $result = mysqli_query($conn, $sql);
    $books_taken_by = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!$result) {
        throw new Exception("Failed to fetch data");
    }
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}
?>
<section class="container">
    <header class="takenheader">
        <div class="tabs">
            <a href="./taken.php" class="tab <?= $returned == -1 ? "activeTab" : "" ?>">All</a>
            <a href="./taken.php?returned=1" class="tab <?= $returned == 1 ? "activeTab" : "" ?>">Returned</a>
            <a href="./taken.php?returned=0" class="tab <?= $returned == 0 ? "activeTab" : "" ?>">Not Return</a>
        </div>

        <a href="../lib/takenadd.php" class="addtakenbtn">Add New +</a>
    </header>
    <?php
    if (count($books_taken_by) < 1) {
        echo "No Book taker Found";
    }
    ?>
    <table class="takentabel">
        <tr>
            <th>Student Name</th>
            <th>Book Name</th>
            <th>Taken Date</th>
            <th>Return Date</th>
            <th>Has Returned</th>
            <th>Edit</th>
        </tr>
        <?php foreach ($books_taken_by as $book_taken_by): ?>
            <tr>
                <td><?= $book_taken_by['studentName']; ?></td>
                <td><?= $book_taken_by['bookName']; ?></td>
                <td><?= str_split($book_taken_by['taken_date'], 10)[0] ?></td>
                <td><?= str_split($book_taken_by['return_date'], 10)[0] ?></td>
                <td><?= $book_taken_by['has_returned'] == 1 ? "<span class='tab'>returned</span>" : "<span class='tab activeTab'>not return</span>" ?>

                </td>
                <td>
                    <div class="bookBtnContainer">
                        <a href="" class="bookDeleteBtn">Remove</a>
                        <a href="./takenedit.php" class="bookEditBtn">Edit</a>
                    </div>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php include_once('../inc/libloginfooter.php') ?>