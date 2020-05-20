<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
$id = $_GET['id'];
$PRODUCT_REVIEW = new ProductReview($id);
?> 


<!DOCTYPE html>


<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit product Review</title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">  
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2> Edit Product Review</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-product-review.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/product-review.php" enctype="multipart/form-data"> 
                                    <!--                                    <div class="col-md-12">                                       
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <select class="form-control" name="customer">
                                                                                        <option> -- Please Select the Customer -- </option> 
                                    <?php
                                    $CUSTOMER = new Customer(NULL);
                                    foreach ($CUSTOMER->all() as $customer) {
                                        ?>
                                                                                                                                                                <option value="<?php echo $customer['id'] ?>"> <?php echo $customer['name'] ?></option> 
                                    <?php }
                                    ?>
                                                                                    </select> 
                                                                                </div>
                                                                            </div>
                                                                        </div>-->

                                    <!--                                    <div class="col-md-12">                                       
                                                                            <div class="form-group form-float">
                                                                                <div class="form-line">
                                                                                    <select class="form-control" name="product">
                                                                                        <option> -- Please Select the product -- </option> 
                                    <?php
                                    $CUSTOMER = new Product(NULL);
                                    foreach ($CUSTOMER->all() as $product) {
                                        ?>
                                                                                                                                                                <option value="<?php echo $product['id'] ?>"> <?php echo $product['name'] ?></option> 
                                    <?php }
                                    ?>
                                                                                    </select> 
                                                                                </div>
                                                                            </div>
                                                                        </div>-->

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" name="stars">
                                                    <option> -- Please Select the Stars -- </option>      
                                                    <?php
                                                    if ($PRODUCT_REVIEW->stars == 1) {
                                                        ?>

                                                        <option value="1" selected="">1</option> 
                                                        <option value="2">2</option> 
                                                        <option value="3">3</option> 
                                                        <option value="4">4</option> 
                                                        <option value="5">5</option> 
                                                    <?php } else if ($PRODUCT_REVIEW->stars == 2) { ?>

                                                        <option value="1" >1</option> 
                                                        <option value="2" selected="">2</option> 
                                                        <option value="3">3</option> 
                                                        <option value="4">4</option> 
                                                        <option value="5">5</option> 
                                                    <?php } else if ($PRODUCT_REVIEW->stars == 3) { ?>
                                                        <option value="1" >1</option> 
                                                        <option value="2" >2</option> 
                                                        <option value="3" selected="">3</option> 
                                                        <option value="4">4</option> 
                                                        <option value="5">5</option> 
                                                    <?php } else if ($PRODUCT_REVIEW->stars == 4) { ?>
                                                        <option value="1" >1</option> 
                                                        <option value="2" >2</option> 
                                                        <option value="3" >3</option> 
                                                        <option value="4" selected="">4</option> 
                                                        <option value="5">5</option> 
                                                    <?php } else if ($PRODUCT_REVIEW->stars == 5) { ?>
                                                        <option value="1" >1</option> 
                                                        <option value="2" >2</option> 
                                                        <option value="3" >3</option> 
                                                        <option value="4" >4</option> 
                                                        <option value="5" selected="">5</option> 
                                                    <?php } ?>

                                                </select> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="title" class="form-control"  autocomplete="off" name="title" required="true" value="<?php echo $PRODUCT_REVIEW->title ?>">
                                                <label class="form-label">Title</label>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <label class="form-label">Description</label>
                                            <div class="form-line">
                                                <textarea id="description" name="description" class="form-control" rows="5"><?php echo $PRODUCT_REVIEW->description ?></textarea> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="filled-in chk-col-pink" type="checkbox" <?php
                                            if ($PRODUCT_REVIEW->is_active == 1) {
                                                echo 'checked';
                                            }
                                            ?> name="active" value="1" id="rememberme" />
                                            <label for="rememberme" style="font-size: 16px;"><b>Publish / Unpublish</b></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <input type="submit" name="update" class="btn btn-primary TYPEm-t-15 waves-effect" value="Update"/>
                                    </div>
                                </form>
                            </div>
                            <div class="row"> 
                            </div>
                            <div class="body"> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/bootstrap/js/bootstrap.js"></script> 
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/add-new-ad.js" type="text/javascript"></script>

        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>

       
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="js/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
        <script src="delete/js/product-review.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery('.date-time-picker').datetimepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        </script>

        <script>
            tinymce.init({
                selector: "#description",
                // ===========================================
                // INCLUDE THE PLUGIN
                // ===========================================

                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                // ===========================================
                // PUT PLUGIN'S BUTTON on the toolbar
                // ===========================================

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                // ===========================================
                // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
                // ===========================================

                relative_urls: false

            });


        </script>
    </body>

</html>