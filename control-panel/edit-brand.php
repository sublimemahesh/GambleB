<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
$id = $_GET['id'];

$BRAND = new Brand($id);
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Brand </title>
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
                                <h2>Edit Brand </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-brand.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/brand.php" enctype="multipart/form-data"> 

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="name" class="hidden-lg hidden-md">Name</label>
                                                    <input type="text" id="name" class="form-control"  autocomplete="off" name="name" required="true" value="<?php echo $BRAND->name ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="logo">Logo</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <label for="logo" class="hidden-lg hidden-md">Logo</label>
                                                <input type="file" id="logo" class="form-control" name="logo" >
                                                <?php if ($BRAND->logo == NULL) { ?>
                                                    <img src="../upload/product-categories/product-no-image.jpg" class="img-responsive img-thumbnail">

                                                <?php } else { ?>
                                                    <img src="../upload/product-categories/product/brands/logo/<?php echo $BRAND->logo; ?>" class="img-responsive img-thumbnail">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                     

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">

                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <input type="hidden" id="oldImageIcon" value="<?php echo $BRAND->logo; ?>" name="oldImageLogo"/> 
                                            <input type="hidden" id="id" value="<?php echo $BRAND->id; ?>" name="id"/>
                                            <input type="submit" name="update" class="btn btn-primary m-t-15 waves-effect" value="update"/>

                                        </div>
                                    </div>

                                </form>
                                <div class="row clearfix">  </div>
                                <hr/>
                                </form>
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


        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
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