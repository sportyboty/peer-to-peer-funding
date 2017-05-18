<?php
session_start();

require_once "../vendor/autoload.php";

$title = "All users";

$page = "admin";

use MerryPayout\Admin;

$admin = new Admin();
$admin->checkAuth();
$histories = $admin->getAllMergedUsers();

if (isset($_POST['search'])) {
    $allUsers = $admin->searchUserByUsername($_POST['search_name']);

}

?>


<?php
$userInfo = $admin->getDetails();
require_once "includes/header.php";
?>
<body>

<div class="wrapper comic-sans">


    <?php require_once "includes/side-bar.php"; ?>
    <!-- left-bar -->
    <div class="content" id="content">

        <div class="overlay"></div>

        <?php require_once "includes/top-bar.php"; ?>
        <!-- /top-bar -->
        <div class="main-content">
            <div class="row">

                <div style="text-align: center;">
                    <form method="post">
                        <input type="submit" name="mergeAll" class="btn btn-success btn-lg btn-round" value="Merge All">
                    </form>
                </div>
                <div>
                    <form method="post" class="form-inline">
                        <input type="text" class="form-control" title="" name="search_name">
                        <input type="submit" class="btn btn-lg btn-success btn-round" name="search" value="Search">
                    </form>
                </div>
                <div>

                </div>
                <table class="table table-striped table-bordered table-hover table-full-width" id="users_table">
                    <thead>
                    <tr>
                        <th style="text-align: center;">Receiver ID</th>
                        <th style="text-align: center;">Receiver Username</th>
                        <th style="text-align: center;">Payer ID</th>
                        <th style="text-align: center;">Payer Username</th>
                        <th style="text-align: center;">Transaction Amount</th>
                        <th style="text-align: center;">Transaction Status</th>
                        <th style="text-align: center;">Delete Record</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($histories as $history) {
                        ?>
                        <tr>
                            <td style="text-align: center;">
                                <?php print $history['receiver_id']; ?>
                            </td>
                            <td style="text-align: center;">
                                <a href=""><?php print $history['receiver_username']; ?> </a>
                            </td>
                            <td style="text-align: center;">
                                <a href=""><?php print $history['payer_id']; ?> </a>
                            </td>
                            <td style="text-align: center;">
                                <a href=""><?php print $history['payer_username']; ?> </a>
                            </td>
                            <td style="text-align: center;">
                                <a href=""><?php print $history['amount']; ?> </a>
                            </td>
                            <td style="text-align: center;">
                                <label
                                    class='label <?php echo $history["confirm_status"] == 1 ? "label-success" : "label-danger";
                                    ?>'>  <?php echo $history["confirm_status"] == 1 ? "successful" : "pending"; ?>
                                </label>
                            </td>
                            <td style="text-align: center;">
                                <a href="delete_record?t_id=<?php echo $history['id']; ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
            <!-- row -->
        </div>
    </div>
</div>
<!-- wrapper -->



<?php require_once "includes/footer.php"; ?>
