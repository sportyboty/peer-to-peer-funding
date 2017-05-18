<!-- HEADER -->

<header>
    <div class="container">
        <div id="logo-wrapper">
            <div class="cell-view"><a id="logo" href="index"><img src="img/merrypayout.png" alt=""/></a></div>
        </div>
        <div class="open-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="header-container">
            <div class="scrollable-container">
                <div class="header-left">
                    <nav>
                        <div class="menu-entry <?php echo $pageName == 'home' ? 'active' : '' ?>">
                            <a href="index">Home</a>
                        </div>

                        <div class="menu-entry <?php echo $pageName == 'about' ? 'active' : '' ?>">
                            <a href="about">About Us</a>
                        </div>

                        <div class="menu-entry <?php echo $pageName == 'contact' ? 'active' : '' ?>">
                            <a href="contact">Contact Us</a>

                        </div>
                        <div class="menu-entry <?php echo $pageName == 'faq' ? 'active' : '' ?>">
                            <a href="faq">Faq</a>
                        </div>
                        <div class="menu-entry <?php echo $pageName == 'terms' ? 'active' : '' ?>">
                            <a href="terms">Terms & Condition</a>
                        </div>

                    </nav>
                </div>
                <div class="header-right">
                    <div class="header-inline-entry">
                        <div><span class="glyphicon glyphicon-time"></span><b>24/7</b> Customer Support</div>
                    </div>
                    <div class="header-inline-entry">
                        <a class="button" href="signin">login</a>
                    </div>
                    <div class="header-inline-entry">
                        <a class="<?php echo $pageName == 'signup' ? 'button' : 'link' ?>" href="signup">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
