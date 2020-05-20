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

        <title>Agreement - CashOnDelivery.Lk</title>

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
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">

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
                <i class="fa fa-pencil-square-o"></i> : Dealer Agreement 
            </div>
            <?php
            if (isset($_GET['status'])) {
                if (isset($_GET['status']) == 'complate') {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Inactive!</strong> Your account is not active yet. Please complete dealer agreement to active your accountW.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="row">
                <div class="col-md-12 text-justify agreement">
                    <p>
                        I <?php echo $DEALER->name; ?>, holding NIC - <?php echo $DEALER->nic; ?> hereby accept the fact that I am logged in as one of the vendor to the website www.cashondelivery.lk , and I take the full responsibility over the orders accepted by me, including the pricing, and the quality of the products, and I do fully understand www.cashondelivery.lk is only a web portal that facilitate us to get online orders and to get connected with customers and www.cashondelivery.lk will have no legal liability towards the customer in any case with regards of pricing published on the website instead the prices for the products are being published and accepted by me as a vender and www.cashondelivery.lk will not be liable for any undelivered order or missing item or damaged or expired items, instead I will be liable as the vender handling the order, which I personally accepted from the online web portal www.cashondelivery.lk . 
                    </p>

                    <p>
                        I Accept the fact that www.cashondelivery.lk has advised me on pricing (not to over price) any item on the website, or not to overcharge above the maximum retail price stated on any product, in such case if the customer will be overcharged on delivery, I will responsible for the charges. 
                    </p>

                    <p>
                        I agree to pay a commission worth 300.00LKR from each order I deliver, to the selected areas on my dealer account (selected by me) and this will be from the ,650 LKR total delivery charge that I will charge from the customer per delivery, thus 350 LKR for me and 300 LKR for the www.cashondelivery.lk and delivery charge will not be increased under any circumstances for the areas selected by me on creating the account with www.cashondelivery.lk And I am fully aware that this contract can be terminated by www.cashondelivery.lk at any given time, without further notice, if I will violate the agreement any time.
                    </p>
                    <hr/>
                    <ul>
                        <li> - Business Name: <?php echo $DEALER->business_name; ?></li>
                        <li> - BR Number: <?php echo $DEALER->br_number; ?></li>
                        <?php $CITY = new City($DEALER->city) ?>
                        <li> - Address: <?php echo $DEALER->address; ?> - <?php echo $CITY->name; ?></li>
                        <li> - Phone: <?php echo $DEALER->phone; ?></li>
                        <li> - Email: <?php echo $DEALER->email; ?></li>
                    </ul>
                    <hr/>
                    <div class="btn btn-lg btn-info" id="send-agreement" data-dealer="<?php echo $DEALER->id; ?>">Send & Sign Agreement</div>
                </div>
            </div>
        </div>

    </div>
    <?php include './footer.php'; ?> 

    <!-- Jquery js -->
    <script src="../js/jquery.min.js" type="text/javascript"></script>

    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

    <!-- Custom css -->
    <script src="../js/custom.js" type="text/javascript"></script>  

    <script src="js/dealer.js" type="text/javascript"></script> 
    <?php
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
    ?>  
</body>
</html>	