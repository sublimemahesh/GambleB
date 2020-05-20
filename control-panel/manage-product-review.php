<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Product Review </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid"> 
                <!-- Manage Districts -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Product Review
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-product-review.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Product</th> 
                                                    <th>Stars</th>  
                                                    <th>Date & Time</th>
                                                    <th>Publish / Unpublish</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Customer</th>
                                                    <th>Product</th> 
                                                    <th>Stars</th>                                                  
                                                    <th>Date & Time</th>
                                                    <th>Publish / Unpublish</th>
                                                    <th>Options</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $PRODUCT_REVIEW = new ProductReview(NULL);
                                                foreach ($PRODUCT_REVIEW->all() as $key => $product_review) {
                                                    $key++;
                                                    ?>
                                                    <tr id="div<?php echo $product_review['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td>
                                                            <?php
                                                            $CUSTOMER = new Customer($product_review['customer']);
                                                            echo $CUSTOMER->name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $PRODUCT = new Product($product_review['product']);
                                                            echo $PRODUCT->name;
                                                            ?>
                                                        </td> 
                                                        <td><?php echo $product_review['stars']; ?></td>  
                                                        <td><?php echo $product_review['date_time']; ?></td> 
                                                        <td><?php
                                                            if ($product_review['is_active'] == 1) {
                                                                ?>
                                                                Publish
                                                            <?php } else { ?> 
                                                                Unpublish
                                                            <?php } ?>
                                                        </td> 

                                                        <td>  
                                                            <a href="edit-product-review.php?id=<?php echo $product_review['id']; ?>" title="Edit District"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> |  
                                                            <a href="#"  class="delete-product-review" data-id="<?php echo $product_review['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>
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


        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="delete/js/product-review.js" type="text/javascript"></script>

    </body>

</html> 