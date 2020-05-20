<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Report of Confirmed Order Products</title>
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
                                    Report of Confirmed Order Products
                                </h2>
                            </div>

                            <div class="body">
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-striped table-hover dataTable" id="completed-orders">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product</th>
                                                <th>Brand</th>                               
                                                <th>Qty</th> 
                                                <th>Unit</th> 
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $categories = ProductCategories::all();
                                            $products = OrderProduct::getConfirmedOrdersProducts();
                                            if (count($products) > 0) {
                                                
                                                foreach ($categories as $key => $category) {
                                                    $id = 0;
                                                    foreach ($products as $key => $product) {
                                                        $PRODUCT = new Product($product['product']);
                                                        if ($PRODUCT->category == $category['id']) {
                                                            $id++;
                                                            $BRAND = new Brand($PRODUCT->brand);
                                                            if ($id == 1) {
                                                                ?>
                                                                <tr>
                                                                    <td colspan="5" class="text-bold"><?php echo $category['name'];?></td>
                                                                </tr>

                                                                <?php
                                                            }
                                                            ?>
                                                            <tr id="row_<?php echo $product['id']; ?>">
                                                                <td><?php echo $id; ?></td> 
                                                                <td><?php echo $PRODUCT->name; ?></td> 
                                                                <td><?php echo $BRAND->name; ?></td> 
                                                                <td><?php echo $product['qty']; ?></td>
                                                                <td><?php echo $PRODUCT->unite; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
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