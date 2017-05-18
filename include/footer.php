<footer>
    <div class="container">
        <div class="row">
            <div class="footer-entry col-md-3">
                <h3 class="title">Merrypayout</h3>
                <div class="text">
                    MerryPayout! Is a mutual funding platform by member to member donations.
                    By using this platform, members give and receive 200% of their investment
                </div>
            </div>
            <div class="footer-entry col-md-2 col-sm-3 col-xs-6">
                <h3 class="title">Merrypayout</h3>
                <ul>
                    <li><a href="about">About</a></li>
                    <li><a href="contact">Contact</a></li>
                    <li><a href="faq">Faq</a></li>
                    <li><a href="terms">Terms & Condition</a></li>
                    <li><a href="signup" id="register">Sign Up</a></li>
                    <li><a href="signin">Login</a></li>
                </ul>
            </div>
            <div class="footer-entry col-md-2 col-sm-3 col-xs-6">
                <h3 class="title">Comodo Secure</h3>
                <ul>

                    <li><img src="img/comodo_secure_seal_113x59_transp.png" width="100px" alt=""/></li>
                </ul>
            </div>
            <div class="clearfix visible-xs"></div>
            <div class="footer-entry col-md-5 col-sm-6 col-xs-12">
                <h3 class="title">Newsletter Subscribe</h3>
                <strong><?php echo $msg; ?></strong>
                <div class="text">Get Updates and upgrades about platform.</div>
                <div class="subscription-form">
                    <form method="post">
                        <input name="email" type="email" placeholder="Your Email..."/>
                        <input name="submit" type="submit" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-line">
        <div class="container">
            <div class="row">
                <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                    <img src="img/icon-22.png" alt=""/>
                    <div class="content">
                        <div class="cell-view">24/7 Custtomer Support</div>
                    </div>
                </div>
                <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">
                    <img src="img/icon-23.png" alt=""/>
                    <div class="content">
                        <div class="cell-view"><a href="mailto:support@merrypayout.com">support@merrypayout.com</a><br>
                            <a href="mailto:client@merrypayout.com">client@merrypayout.com</a><br>
                            <a href="mailto:tech@merrypayout.com">tech@merrypayout.com</a></div>
                    </div>
                </div>
<!--                <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">-->
<!--                    <img src="img/icon-24.png" alt=""/>-->
<!--                    <div class="content">-->
<!--                        <div class="cell-view"><a href="tel:+2348128623341 ">+2348128623341 </a></div>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="footer-line-entry col-md-3 col-sm-6 col-xs-12">


                        <div class="copyright">&copy; 2017 All rights reserved. Merrypayout</div>

                </div>

            </div>
        </div>
    </div>
</footer>


<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/idangerous.swiper.min.js"></script>
<script src="js/global.js"></script>
<script src="js/wow.min.js"></script>
<script>
    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       100,          // distance to the element when triggering the animation (default is 0)
            mobile:       true,       // trigger animations on mobile devices (default is true)
            live:         true,       // act on asynchronously loaded content (default is true)
            callback:     function(box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            }
        }
    );
    wow.init();
</script>
</body>
</html>