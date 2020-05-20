<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');

if (!isset($_SESSION)) {
    session_start();
}
$CUSTOMER = new Customer($_SESSION["id"]);
$DISTRICT = new District($CUSTOMER->district);
$CITY = new City($CUSTOMER->city);
?>
<!DOCTYPE HTML>
<html lang="en-US"> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>FRESHCART.LK</title>


        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="robots" content="noodp,index,follow" />
        <meta name='revisit-after' content='1 days' />

        <link rel="icon" href="../images/logo-favicon.png" type="images/logo-favicon.png">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="../css/libs/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/font-linearicons.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/bootstrap-theme.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/jquery.fancybox.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.carousel.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.transitions.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/owl.theme.css"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/query.mCustomScrollbar.html"/>
        <link rel="stylesheet" type="text/css" href="../css/libs/settings.css"/>
        <link rel="stylesheet" type="text/css" href="../css/theme.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="../css/responsive.css" media="all"/>
        <link rel="stylesheet" type="text/css" href="../css/hover-effect.css" media="all"/> 
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../css/modle-login.css" rel="stylesheet" type="text/css"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css"/>


        <link href="../css/caption-hover-effects/default.css" rel="stylesheet" type="text/css"/>
        <link href="../css/caption-hover-effects/component.css" rel="stylesheet" type="text/css"/> 

        <link href="../control-panel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrap">
            <?php include './header.php'; ?> 
            <div id="content">
                <div class="container">
                    <div class="row">

                        <!--  Navigation Main Categories-->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="item-feature-box text-center feature-box-style-11">
                                    <a href="edit-profile.php"><i class="fa fa-pencil-square edit-profile-icon"></i></a>
                                    <div class="feature-box-icon">
                                        <a href="#" class="feature-box-link">
                                            <?php
                                            if ($CUSTOMER->image_name) {
                                                ?>
                                                <img src="../upload/customer/profile/<?php echo $CUSTOMER->image_name; ?>" alt="" class="img-circle"/>
                                                <?php
                                            } else {
                                                ?>
                                                <img src="../images/user1.png" alt="" class="img-circle"/>
                                                <?php
                                            }
                                            ?>

                                        </a>
                                    </div>
                                    <div class="feature-box-info">
                                        <h3><a href="#"><?php echo $CUSTOMER->name; ?></a></h3>
                                        <p>Email: <?php echo $CUSTOMER->email; ?></p>
                                        <p>Phone Number: <?php echo $CUSTOMER->phone_number; ?></p>
                                        <p>Address: <?php echo $CUSTOMER->address; ?></p>
                                        <p>District: <?php echo $DISTRICT->name; ?></p>
                                        <p>City: <?php echo $CITY->name; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!--  Navigation Main Categories -->

                        <!--  Offers -->

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="panel pane-info">
                                <div class="panel-body">
                                    <div class="table-responsive">

                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="view-data-table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th> 
                                                    <th>Ordered At</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order ID</th> 
                                                    <th>Ordered At</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                foreach (Order::getOrdersByCustomer($_SESSION['id']) as $key => $order) {
                                                    $key++;
                                                    ?>
                                                    <tr id="div_<?php echo $order['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td><?php echo '#' . $order['id']; ?></td> 
                                                        <td><?php echo $order['ordered_at']; ?></td> 
                                                        <td class="text-right">Rs. <?php echo number_format($order['amount'], 2); ?></td> 
                                                        <td>
                                                            <?php
                                                            if ($order['status'] == 0) {
                                                                echo 'Canceled';
                                                            } else if ($order['delivery_status'] == 0) {
                                                                echo 'Pending';
                                                            } else if ($order['delivery_status'] == 1) {
                                                                echo 'Confirmed';
                                                            } else if ($order['delivery_status'] == 2) {
                                                                echo 'Success';
                                                            }
                                                            ?>
                                                        </td> 
                                                        <td>  
                                                            <a href="view-order.php?id=<?php echo $order['id']; ?>" title="View Order"> <button class="fa fa-eye btn-info edit-btn"></button></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>	
            </div>
            <?php include './footer.php'; ?>
        </div>
        <script type="text/javascript" src="../js/libs/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../js/libs/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.fancybox.js"></script>
        <script type="text/javascript" src="../js/libs/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/libs/owl.carousel.js"></script>
        <script type="text/javascript" src="../js/libs/TimeCircles.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.countdown.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.themepunch.revolution.js"></script>
        <script type="text/javascript" src="../js/libs/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="../js/theme.js"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!--<script src="../js/ajax/add_to_cart.js" type="text/javascript"></script>-->
        <script src="../js/ajax/login.js" type="text/javascript"></script> 
        <script src="../js/caption-hover-effects/modernizr.custom.js" type="text/javascript"></script> 
        <script src="../js/caption-hover-effects/toucheffects.js" type="text/javascript"></script> 
        <script src="../control-panel/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="../control-panel/js/pages/tables/jquery-datatable.js"></script>
    </body> 
</html>