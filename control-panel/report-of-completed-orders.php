<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Report of Completed Orders</title>
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                                    Report of Completed Orders
                                </h2>
                            </div>

                            <div class="body">
                                <div class="row date-section">
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="from" class="form-control"  autocomplete="off" name="from" required="true">
                                                <label class="form-label">From</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="to" class="form-control"  autocomplete="off" name="to" required="true">
                                                <label class="form-label">To</label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="status" name="status" value="2">
                                </div>
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-hover dataTable" id="completed-orders">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order ID</th>
                                                <th>Ordered At</th>                               
                                                <th>Completed At</th>                               
                                                <th>Full Name</th>                              
                                                <th>Address</th>                              
                                                <th>Product</th>                               
                                                <th>Qty</th>                               
                                                <th>Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $orders = Order::getOrdersByDeliveryStatus(2);
                                            $total = 0;
                                            if (count($orders) > 0) {
                                                foreach ($orders as $key => $order) {
                                                    $total += $order['amount'];
                                                    $key++;
                                                    $PRODUCT = new Product($order['product']);
                                                    ?>
                                                    <tr id="row_<?php echo $order['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td><?php echo $order['id']; ?></td> 
                                                        <td><?php echo $order['ordered_at']; ?></td> 
                                                        <td><?php echo $order['completed_at']; ?></td> 
                                                        <td><?php echo $order['first_name'] . ' ' . $order['last_name']; ?></td> 
                                                        <td><?php echo $order['address']; ?></td>
                                                        <td><?php echo $PRODUCT->name; ?></td> 
                                                        <td><?php echo $order['qty']; ?></td> 
                                                        <td class="text-right"><?php echo number_format($order['amount'], 2); ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>   
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>             
                                                <th></th>             
                                                <th></th>             
                                                <th></th>             
                                                <th></th>             
                                                <th></th>             
                                                <th></th>             
                                                <th class="text-right">Total</th>             
                                                <th id="amount-total" class="text-right"><?php echo number_format($total, 2); ?></th>
                                            </tr>
                                        </tfoot>
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/report-of-completed-orders.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#completed-orders').DataTable({
                    "order": [[0, "asc"]],
                    responsive: true,
                    iDisplayLength: 100,
                    aLengthMenu: [[100, 500, 1000, 2000, -1], [100, 500, 1000, 2000, "All"]],
                    dom: 'Bfrtip',
                    buttons: [
                        {extend: 'pdf', footer: true},
                        {extend: 'print', footer: true}
                    ]
                });
            });
        </script>
        <script>
            $(function () {
                $("#from").datepicker({dateFormat: 'yy-mm-dd'});
                $("#to").datepicker({dateFormat: 'yy-mm-dd'});
            });
        </script>
    </body>

</html> 