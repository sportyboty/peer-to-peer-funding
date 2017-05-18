<div class="left-bar " style="overflow: hidden; outline: none; tabindex="0">
    <div class="admin-logo" style="background-color:#2196f3;">
        <div class="logo-holder pull-left">
            <!--            <img class="logo" src="../img/MerryPayout.png" alt="logo">-->
            <span style="font-size: 18px; font-weight: bolder;"> <span
                        style="color:whitesmoke">LillyPay</span></span>
        </div>
        <!-- logo-holder -->
        <a href="#" class="menu-bar  pull-right" style="background-color: #0c82df;"><i
                    class="ti-menu"></i></a>
    </div>
    <!-- admin-logo -->
    <ul class="list-unstyled menu-parent" id="mainMenu">
        <li class="<?php echo $pagename == 'dashboard' ? 'current' : ''; ?>">
            <a href="index" class="current waves-effect waves-light">
                <i class="fa fa-home" style="color: #0a6ebd;"></i>
                <span class="text ">Account Home</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'givehelp' ? 'current' : ''; ?>">
            <a href="givehelp" class="current waves-effect waves-light">
                <i style="color: #0a6ebd;">‎₦</i>
                <span class="text ">Donate</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'confirmpayment' ? 'current' : ''; ?>">
            <a href="confirm_payment" class="current waves-effect waves-light">
                <i class="fa fa-thumbs-up" style="color: #0a6ebd;"></i>
                <span class="text ">Confirm Payment</span>
            </a>
        </li>

        <li class="<?php echo $pagename == 'history' ? 'current' : ''; ?>">
            <a href="history" class="current waves-effect waves-light">
                <i class="fa fa-history" style="color: #0a6ebd;"></i>
                <span class="text ">Money History</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'referral' ? 'current' : ''; ?>">
            <a href="referral" class="current waves-effect waves-light">
                <i class="fa fa-users" style="color: #0a6ebd;"></i>
                <span class="text ">Referral Program</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'yourreferrals' ? 'current' : ''; ?>">
            <a href="yourreferrals" class="current waves-effect waves-light">
                <i class="fa fa-list-alt" style="color: #0a6ebd;"></i>
                <span class="text ">Your Referrals</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'editprofile' ? 'current' : ''; ?>">
            <a href="edit_profile" class="current waves-effect waves-light">
                <i class="fa fa-user" style="color: #0a6ebd;"></i>
                <span class="text ">Edit Profile</span>
            </a>
        </li>
        <li class="<?php echo $pagename == 'changepassword' ? 'current' : ''; ?>">
            <a href="change_passwords" class="current waves-effect waves-light">
                <i class="fa fa-lock" style="color: #0a6ebd;"></i>
                <span class="text ">Change Password</span>
            </a>
        </li>
        <?php
        $user = new \MerryPayout\User();
        if ($user->isAdmin()) {
            ?>
            <li>
                <a href="admin_view_users" class="current waves-effect waves-light">
                    <i class="fa fa-gear" style="color: #0a6ebd;"></i>
                    <span class="text ">Manage Users</span>
                </a>
            </li>

        <?php }
        if ($user->isSuperUser() || $user->isAdmin()) { ?>
            <li>
                <a href="superuser" class="current waves-effect waves-light">
                    <i class="fa fa-gear" style="color: #0a6ebd;"></i>
                    <span class="text ">Merge</span>
                </a>
            </li>
        <?php }
        if ($user->isAdmin()) { ?>
            <li>
                <a href="view_merged_users" class="current waves-effect waves-light">
                    <i class="fa fa-gear" style="color: #0a6ebd;"></i>
                    <span class="text">All Merged Records</span>
                </a>
            </li>
        <?php } ?>
        <li>
            <a href="logout" class="current waves-effect waves-light">
                <i class="fa fa-sign-out" style="color: #0a6ebd;"></i>
                <span class="text ">Log Out</span>
            </a>
        </li>
    </ul>
</div>