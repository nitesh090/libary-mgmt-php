<?php include_once('../inc/studentheader.php');
include_once('../inc/db.php') ?>

<?php

$id = $_SESSION['id'];
try {
    $sql = "SELECT id,name,email FROM user WHERE id='$id'";
    $conn = getDB();
    $result = mysqli_query($conn, $sql);
    $students = mysqli_fetch_assoc($result);

    $sql = "SELECT b.name,b.author,bt.taken_date, bt.return_date, bt.has_returned FROM book b JOIN book_taken_by bt ON bt.book_id=b.id JOIN user s ON bt.student_id=s.id WHERE s.id='$id';";
    $conn = getDB();
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
} catch (Exception $ex) {
    echo ("Error: " . $ex->getMessage());
}
?>

<section class="container">
    <div class="stuname">
        <h1><?= $students['name'] ?></h1>
        <div class="semail"><?= $students['email'] ?></div>
    </div>
    <div class="sbook">
        <h2>History</h2>
        <table class="takentabel">
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Taken Date</th>
                    <th>Return Date</th>
                    <th class="tabelstatus">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= $book['name']; ?></td>
                        <td><?= $book['author']; ?></td>
                        <td><?= str_split($book['taken_date'], 10)[0]  ?></td>
                        <td><?= str_split($book['return_date'], 10)[0]  ?></td>
                        <td>
                            <div class="tabs">
                                <?= $book['has_returned'] == 1 ? "<span class='tab'>RETURN</span>" : "<span class='tab activeTab'>NOT RETURN</span>" ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>
<?php include_once('../inc/footer.php') ?>