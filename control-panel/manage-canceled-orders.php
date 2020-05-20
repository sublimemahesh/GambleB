<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?> 
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Canceled Orders</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid"> 
                <!-- Manage Brand -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Canceled Orders
                                </h2>
                            </div>
                            <div class="body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order ID</th>
                                                <th>Ordered At</th>                               
                                                <th>Full Name</th>                              
                                                <th>Location</th>                            
                                                <th>Amount (Rs)</th>                     
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order ID</th>                               
                                                <th>Ordered At</th>                               
                                                <th>Full Name</th>                              
                                                <th>Location</th>                            
                                                <th>Amount (Rs)</th>                             
                                                <th>Option</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php
                                            $orders = Order::getCanceledOrders();
                                            if (count($orders) > 0) {
                                                foreach ($orders as $key => $order) {
                                                    $MEMBER = new Customer($order['member']);
                                                    $DISTRICT = new District($order['district']);
                                                    $CITY = new City($order['city']);
                                                    $key++;
                                                    ?>
                                                    <tr id="row_<?php echo $order['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td><?php echo '#' . $order['id']; ?></td> 
                                                        <td><?php echo $order['ordered_at']; ?></td> 
                                                        <td><?php echo $MEMBER->name; ?></td> 
                                                        <td><?php echo $DISTRICT->name . ' -> ' . $CITY->name; ?></td>
                                                        <td class="text-right"><?php echo $order['amount']; ?></td>
                                                        <td> 
                                                            <a href="view-order.php?id=<?php echo $order['id']; ?>" class=""><i class="glyphicon glyphicon-eye-open view-btn"></i></a> | 
                                                            <a href="#"  class="delete-order" data-id="<?php echo $order['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a> 
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Manage brand -->

            </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>
        <script src="js/demo.js"></script>
        <script src="delete/js/pages.js" type="text/javascript"></script>
        <script src="delete/js/order.js" type="text/javascript"></script>
    </body>
</html>