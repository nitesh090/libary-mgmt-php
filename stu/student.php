<?php include_once('../inc/studentheader.php') ?>
<section class="container">
    <div class="stuname">
        <h1>Student Name</h1>
        <div class="semail">student email</div>
    </div>
    <div class="sbook">
        <h2>History</h2>
        <table class="takentabel">
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Taken Date</th>
                <th>Return Date</th>
                <th class="tabelstatus">Status</th>
            </tr>
            <tr>
                <td>Book Name</td>
                <td>Author</td>
                <td>Taken Date</td>
                <td>Return Date</td>
                <td>
                    <div class="tabs">
                        <span class="tab">Has Return</span>
                        <span class="tab">Not Return</span>
                    </div>
                </td>
        </table>
    </div>

</section>
<?php include_once('../inc/footer.php') ?>