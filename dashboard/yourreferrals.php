<?php
session_start();

require_once "../vendor/autoload.php";

$title = "List of your referrals";

$pagename = "yourreferrals";

use MerryPayout\User;

$user = new User();

$user->checkAuth();

$userInfo = $user->getDetails();


?>

<?php

require_once "includes/header.php";

?>
<body>
<div class="wrapper comic-sans">


    <?php require_once "includes/side-bar.php";?>
    <!-- left-bar -->
    <div class="content" id="content">

        <div class="overlay"></div>

        <?php require_once "includes/top-bar.php" ; ?>
        <!-- /top-bar -->
        <div class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="over-title margin-bottom-15">All Transaction <span class="text-bold">History</span></h5>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="type">
                                History Type
                            </label>
                            <div class="input-group">
                                <select class="form-control" name="type" id="type">
                                    <option value="all">All Referred</option>
                                </select>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>Show
                                    </button>
                                </span>
                            </div>

                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Plan</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <div class="alert alert-info"><strong>Currently We do not support this feature, But it will
                                be available soon..</strong></div>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>


</div>
<!-- wrapper -->


<?php require_once "includes/footer.php" ;?>




