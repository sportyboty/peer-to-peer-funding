<?php
ob_start();
session_start();

require_once "../vendor/autoload.php";

$title = "History of your recent transactions";

$pagename = "history";

use MerryPayout\User;

$user = new User();
$user->checkAuth();

$details = array();
$detailsDesc = "";

if (isset($_POST['showHistory'])) {

    if (\MerryPayout\Validate::String($_POST['detailsToShow'])) {
        $detailsToShow = $_POST['detailsToShow'];

        switch ($detailsToShow) {
            case "deposits":
                $details = $user->getDepositHistory();
                $detailsDesc = "All Deposits";
                break;
            case "withdrawals":
                $details = $user->getWithdrawalHistory();
                $detailsDesc = "All Withdrawals";
                break;
            default:
                $details = $user->getAllHistory();
                $detailsDesc = "All Transactions";
        }
    }
}
?>

<?php

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
                <div class="col-md-12">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="type">
                                History Type
                            </label>
                            <div class="input-group">
                                <select class="form-control" name="detailsToShow" id="type">
                                    <option value="all">All Transactions</option>
                                    <option value="deposits">Deposits</option>
                                    <option value="withdrawals">Withdrawals</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary" name="showHistory">
                                        <i class="fa fa-search"></i>
                                        Show
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <h4 class="over-title margin-bottom-15"><strong><?php echo $detailsDesc; ?></strong></h4>
                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($details as $detail) {
                        ?>
                        <tr>
                            <td><?php echo $detail['date']; ?></td>
                            <td><?php echo $detail['amount']; ?></td>
                            <td><?php echo $detail['confirm_status'] == 1 ? "successful" : "pending"; ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wrapper -->


<?php require_once "includes/footer.php"; ?>




