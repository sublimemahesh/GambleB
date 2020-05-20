<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$PRODUCT = new Product($id);
?> 
<!DOCTYPE html>


<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Create products Photos</title>
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
                                <h2> Product Photos - "<?php echo $PRODUCT->name ?>"</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="view-products.php?id=<?php echo $PRODUCT->sub_category; ?>">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/product-photo.php" enctype="multipart/form-data"> 

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="caption" required="true">
                                                <label class="form-label">Caption</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="file" id="image" class="form-control" name="image" required="true">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12"> 
                                        <input type="hidden" id="id" value="<?php echo $PRODUCT->id; ?>" name="id"/>
                                        <input type="submit" name="create" class="btn btn-primary TYPEm-t-15 waves-effect" value="create"/>
                                    </div>
                                </form>

                            </div>
                            <div class="row">

                            </div>
                            <div class="body">
                                <div class="header">
                                    <h2> Manage Product Photos</h2>

                                </div>

                                <div class="row clearfix">
                                    <?php
                                    $PRODUCT_PHOTO = new ProductPhoto(NULL);
                                    $PRODUCT_PHOTO = $PRODUCT_PHOTO->getProductPhotosById($id);
                                    if (count($PRODUCT_PHOTO) > 0) {
                                        foreach ($PRODUCT_PHOTO as $key => $product_photo) {
                                            ?>
                                            <div class="col-md-3"  id="div<?php echo $product_photo['id']; ?>">
                                                <div class="photo-img-container">
                                                    <img src="../upload/product-categories/sub-category/product/photos/gallery/thumb/<?php echo $product_photo['image_name']; ?>" class="img-responsive img-thumbnail">
                                                </div>
                                                <div class="img-caption">
                                                    <p class="maxlinetitle"><?php echo $product_photo['caption']; ?></p> 
                                                    <a href="#" class="delete-product-photo" data-id="<?php echo $product_photo['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a> | 
                                                    <a href="edit-product-photo.php?id=<?php echo $product_photo['id']; ?>&&product=<?php echo $id ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> | 
                                                    <a href="arrange-product-photo.php?id=<?php echo $id; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a>

                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?> 
                                        <b style="padding-left: 15px;">No Product Photos in the database.</b> 
                                    <?php } ?> 

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- #END# Vertical Layout -->

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

        <script src="delete/js/service-photo.js" type="text/javascript"></script>
        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
        <script src="delete/js/product-photo.js" type="text/javascript"></script>
        
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