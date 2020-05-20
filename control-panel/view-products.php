<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

$PRODUCT_CATEGORIES = new ProductCategories($category);
$SUB_CATEGORY = new SubCategory($id);
?> 
<!DOCTYPE html>


<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Create product</title>
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
                                <h2>Create Product - "<?php echo $SUB_CATEGORY->name ?>" </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="create-sub-category.php?id=<?php echo $SUB_CATEGORY->category; ?>">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/product.php" enctype="multipart/form-data"> 
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" name="brand" required="true">
                                                    <option value=""> -- Please Select the Brand -- </option> 
                                                    <?php
                                                    $BRAND = new Brand(NULL);
                                                    foreach ($BRAND->all() as $brand) {
                                                        ?>
                                                        <option value="<?php echo $brand['id'] ?>"> <?php echo $brand['name'] ?></option> 
                                                    <?php }
                                                    ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  autocomplete="off" name="name" required="true">
                                                <label class="form-label">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="price" class="form-control"  autocomplete="off" name="price" required="true" min="0">
                                                <label class="form-label">Price (Rs)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="discount" class="form-control"  autocomplete="off" name="discount"  min="0">
                                                <label class="form-label">Discount (%)</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="unite" class="form-control"  autocomplete="off" name="unite" required="true">
                                                <label class="form-label">Unit</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="filled-in chk-col-pink" type="checkbox" checked name="in_stock" value="1" id="rememberme" />
                                            <label for="rememberme">In Stock</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="min_qty" class="form-control"  autocomplete="off" name="min_qty" required="true" min="0" step="0.5">
                                                <label class="form-label">Min Quantity</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="max_qty" class="form-control"  autocomplete="off" name="max_qty" required="true" min="0">
                                                <label class="form-label">Max Quantity</label>
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
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="short_description" class="form-control"  autocomplete="off" name="short_description" required="true">
                                                <label class="form-label">Short Description</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <label class="form-label">Description</label>
                                            <div class="form-line">
                                                <textarea id="description" name="description" class="form-control" rows="5"></textarea> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <input type="hidden" id="category" value="<?php echo $PRODUCT_CATEGORIES->id; ?>" name="category"/>
                                        <input type="hidden" id="id" value="<?php echo $SUB_CATEGORY->id; ?>" name="id"/>
                                        <input type="submit" name="create" class="btn btn-primary TYPEm-t-15 waves-effect" value="create"/>
                                    </div>
                                </form>

                            </div>
                            <div class="row">

                            </div>
                            <div class="body">
                                <div class="header">
                                    <h2> Manage Products</h2>

                                </div>

                                <div class="row clearfix">
                                    <?php
                                    $PRODUCT = Product::getProductsBySubProduct($id);
                                    if (count($PRODUCT) > 0) {
                                        foreach ($PRODUCT as $key => $product) {
                                            ?>
                                            <div class="col-md-3"  id="div<?php echo $product['id']; ?>">
                                                <div class="photo-img-container">
                                                    <img src="../upload/product-categories/sub-category/product/photos/<?php echo $product['image_name']; ?>" class="img-responsive img-thumbnail">
                                                </div>
                                                <div class="img-caption">
                                                    <p class="maxlinetitle"><?php echo $product['name']; ?></p>
                                                    <div class="d">
                                                        <a href="edit-product.php?id=<?php echo $product['id']; ?>&&category=<?php echo $id ?>"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> | 
                                                        <a href="arrange-products.php?id=<?php echo $id; ?>">  <button class="glyphicon glyphicon-random arrange-btn"></button></a> | 
                                                        <a href="view-product-photos.php?id=<?php echo $product['id']; ?>" title="Add Product">  <button class="glyphicon glyphicon-picture arrange-btn"></button></a> | 
                                                        <a href="#" class="delete-product" data-id="<?php echo $product['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>

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
        <script src="delete/js/product.js" type="text/javascript"></script>
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