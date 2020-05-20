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
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">

        <link href="lib/data-tables-1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

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
                <i class="fa fa-map-marker"></i> : Pending Orders
            </div>

            <div class="row"> 
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover data_table dataTable" style="width: 100%">
                            <thead>
                                <tr> 
                                    <th class="text-center">No</th>
                                    <th>Order ID</th>
                                    <th>Ordered At</th>
                                    <th>Member</th>
                                    <th>Location</th>  
                                    <th class="text-right">Amount</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach (Order::getPendingOrdersByDealerAreas($DEALER->id) as $key => $order) {
                                    $CITY = new City($order['city']);
                                    $DISTRICT = new District($order['district']);
                                    $CUSTOMER = new Customer($order['member']);
                                    $key++;
                                    ?>
                                    <tr id="row_<?php echo $order['id']; ?>" >
                                        <td class="text-center"><?php echo $key; ?></td> 
                                        <td>#<?php echo $order['id']; ?></td> 
                                        <td><?php echo $order['ordered_at']; ?></td>
                                        <td><?php echo $CUSTOMER->name; ?></td> 
                                        <td><?php echo $DISTRICT->name; ?> -> <?php echo $CITY->name; ?></td>   
                                        <td class="text-right"><?php echo number_format($order['amount'], 2); ?></td>  
                                        <td class="text-center">  
                                            <a href="view-order.php?id=<?php echo $order['id']; ?>" title="View Order"  > <button class="fa fa-link edit-btn btn btn-sm btn-info"></button></a> |  
                                            <a href="#" id="confirm-order" data-id="<?php echo $order['id']; ?>" dealer="<?php echo $DEALER->id; ?>" > <button class="fa fa-check delete-btn btn btn-sm btn-danger"></button></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>   
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Order ID</th>
                                    <th>Ordered At</th>
                                    <th>Member</th>
                                    <th>Location</th> 
                                    <th class="text-right">Amount</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </tfoot>
                        </table>
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
        <script src="js/city.js" type="text/javascript"></script> 
        <script src="js/dealer_area.js" type="text/javascript"></script> 
        <script src="js/confirm-order.js" type="text/javascript"></script> 

        <script src="lib/data-tables-1.10.20/js/jquery.dataTables.min.js"></script>   
        <script src="js/data_tables.js" type="text/javascript"></script> 
   
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