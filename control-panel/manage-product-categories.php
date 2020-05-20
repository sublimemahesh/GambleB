<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage product categories</title>
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
                                    Manage Product Categories
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-product-categories.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">

                                <div>
                                    <div class="row clearfix">
                                        <?php
                                        $PRODUCT_CATEGORIES = new ProductCategories(NULL);
                                        $PRODUCT_CATEGORIES = $PRODUCT_CATEGORIES->all();
                                        if (count($PRODUCT_CATEGORIES) > 0) {
                                            foreach ($PRODUCT_CATEGORIES as $key => $product_categories) {
                                                ?>
                                                <div class="col-md-3"  id="div<?php echo $product_categories['id']; ?>">
                                                    <div class="photo-img-container">
                                                        <?php
                                                        if ($product_categories['icon'] == NULL) {
                                                            ?>
                                                            <img src="../upload/product-categories/product-no-image.jpg" class="img-responsive img-thumbnail">

                                                        <?php } else { ?>
                                                            <img src="../upload/product-categories/icon/<?php echo $product_categories['icon']; ?>" class="img-responsive img-thumbnail">

                                                        <?php } ?>
                                                    </div>
                                                    <div class="img-caption">
                                                        <p class="maxlinetitle"><?php echo $product_categories['name']; ?></p>
                                                        <div class="d">
                                                            <a href="#"  class="delete-product-categories" data-id="<?php echo $product_categories['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a> | 
                                                            <a href="edit-product-categories.php?id=<?php echo $product_categories['id']; ?>" title="Edit Product categories"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> | 
                                                            <a href="arrange-product-categories.php?id=<?php echo $product_categories['id']; ?>" title="Arrange Product categories">  <button class="glyphicon glyphicon-random arrange-btn"></button></a> | 
                                                            <a href="create-sub-category.php?id=<?php echo $product_categories['id']; ?>" title="Add Sub Product">  <button class="glyphicon   glyphicon-shopping-cart warring-btn"></button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?> 
                                            <b style="padding-left: 15px;">No Products in the database.</b> 
                                        <?php } ?> 

                                    </div>
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
        <script src="delete/js/product-categories.js" type="text/javascript"></script>
    </body>

</html> 