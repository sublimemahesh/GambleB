<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include './auth.php';

$DEALER = new Dealer($_SESSION["d_id"]);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Cash on Delivery - Online Shopping Store</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="../image/png" sizes="32x32" href="image/favicon-32x32.png"> 
        <!-- Animation CSS -->
        <link rel="stylesheet" href="../css/animate.css" type="text/css">  
        <!-- Font Css -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap Css --> 
        <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">

        <!-- main css --> 
        <link href="../css/style.css" type="text/css" rel="stylesheet">
        <link href="../css/responsive.css" type="text/css" rel="stylesheet">
        <link href="css/custom.css" type="text/css" rel="stylesheet">

    </head>
    <body class="theme-2">
        <!-- LOADER -->
        <div id="preloader">
            <div class="loading_wrap">
                <img src="../image/logo.jpg" alt="logo">
            </div>
        </div>
        <!-- LOADER -->

        <?php include './header.php'; ?>
        <div class="container">
            <div class="header-bar">
                <i class="fa fa-dashboard"></i> : Dashboard 
            </div>

            <div class="row">
                <div class="col-md-3">
                    <a class="sub-box text-center" href="pending-orders.php">
                        <b>Pending Orders</b> 
                        <hr/>
                        <i class="fa fa-spinner"></i> 
                        <hr/>
                        <b><?php echo count(Order::getPendingOrdersByDealerAreas($DEALER->id)); ?></b> 
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="sub-box text-center" href="confirmed-orders.php">
                        <b>Confirmed Orders</b> 
                        <hr/>
                        <i class="fa fa-check-circle-o text-danger"></i> 
                        <hr/>
                        <b><?php echo count(Order::getDealerConfirmedOrders($DEALER->id)); ?></b> 
                    </a>
                </div> 
                <div class="col-md-3">
                    <a class="sub-box text-center" href="completed-orders.php">
                        <b>Competed Orders</b> 
                        <hr/>
                        <i class="fa fa-money text-danger"></i> 
                        <hr/>
                        <b><?php echo count(Order::getDealerCompletedOrders($DEALER->id)); ?></b> 
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="sub-box text-center">
                        <b>Due Payment</b> 
                        <hr/>
                        <i class="fa fa-money "></i> 
                        <hr/>
                        <b>00.00LKR</b> 
                    </div>
                </div>
            </div>

        </div>
        <?php include './footer.php'; ?> 

        <!-- Jquery js -->
        <script src="../js/jquery.min.js" type="text/javascript"></script>

        <script src="../js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="../js/custom.js" type="text/javascript"></script>   
        <?php
        $DEALER = new Dealer($_SESSION["d_id"]);

        $result = $DEALER->checkEmptyData();
        if ($result != 0) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.location.replace("edit-profile.php?status=complate");
                });
            </script>
            <?php
        }

        $agreement = $DEALER->checkAgreement();
    
        if ($agreement == 0) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.location.replace("agreement.php?status=complate");
                });
            </script>
            <?php
        }
        ?>  
    </body>
</html>	