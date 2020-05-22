<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/online-status.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

        <title>Contact Us || GambleB</title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/magnific-popup.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
        <!-- Main css -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="contact-form/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <!-- Preloader -->
        <div class="preloader">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div><!--/Preloader -->
        <?php
        include './header.php';
        ?>

        <!--breadcrumb area-->
        <section class="breadcrumb-area blue-overlay" style="background: url('assets/images/banner/3.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="site-breadcrumb">
                            <h2>Contact us</h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li>Contact us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/breadcrumb area-->

        <!--Contact Section-->
        <section class="section-padding-2 blue-bg shaded-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 centered">
                        <div class="section-title cl-white">
                            <h4>Any query?</h4>
                            <h2>Feel free to message us</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                        <div class="contact-form mb-30">
                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-sm-12">
                                        <input type="text" placeholder="Full Name" id="txtFullName">
                                        <span id="spanFullName"></span>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-sm-12">
                                        <input type="text" placeholder="Phone" id="txtPhone">
                                        <span id="spanPhone"></span>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                        <input type="email" placeholder="Email" id="txtEmail">
                                        <span id="spanEmail"></span>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                        <textarea name="msg" rows="4" id="txtMessage" placeholder="Your message"></textarea>
                                        <span id="spanMessage"></span>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-sm-12">
                                        <input type="text" placeholder="Security Code" name="captchacode" id="captchacode" />
                                        <span id="capspan"></span>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-sm-12">
                                        <?php
                                        include ("./contact-form/captchacode-widget.php");
                                        ?>
                                        <img id="checking" src="contact-form/img/checking.gif" alt=""/>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-sm-12">
                                        <button type="button" id="btnSubmit" class="bttn-mid btn-fill">Send message</button>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 contact-us-button">
                                        <div id="dismessage" align="center" class="msg-success"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/Contact Section-->

        <?php
        include './footer.php';
        ?>




        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/jquery-migrate.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/magnific-popup.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scrollUp.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="contact-form/scripts.js" type="text/javascript"></script>
    </body>

</html>