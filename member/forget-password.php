<?php
include_once(dirname(__FILE__) . '/../class/include.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>GambleB</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="image/png" sizes="32x32" href="../image/favicon-32x32.png"> 
        <!-- Font Css -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap Css --> 
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet"> 
        <!-- main css --> 
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <link href="css/responsive.css" type="text/css" rel="stylesheet">


        <link href="../control-panel/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>

    </head>
    <body class="theme-2">

        <div class="container text-center">
            <img src="../images/logo/logo.png" class="logo-login" style="width: 150px"/>
            <B>Member Dashbord</B>
        </div>
        <!-- Start My Account Section -->
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="title text-center">
                            <h4>Forget Password...</h4>
                        </div>
                        <form method="post" class="login_form " id="forget-form">
                            <div class="form-group">
                                <label>Enter Your Email <span class="required text-danger">*</span></label>
                                <input type="email" required="" class="form-control" name="forget_email"  id="forget_email">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="login" id="forget_pass" value="Send Email">Send Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- End My Account Section -->

        <!-- End Quickview Popup Section -->
        <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>

        <!-- Jquery js -->
        <script src="js/jquery.min.js" type="text/javascript"></script> 

        <!-- Bootstrap js -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <script src="ajax/js/login.js" type="text/javascript"></script> 

        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="js/forgot-password.js" type="text/javascript"></script>
    </body>
</html>	