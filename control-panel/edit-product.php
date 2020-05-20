<?php
//
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$category = '';
if (isset($_GET['category'])) {
    $category = $_GET['category'];
}

$PRODUCT = new Product($id);
?> 

<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit Product</title>
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
                                <h2>
                                    Edit Product
                                </h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="view-products.php?id=<?php echo $category ?>">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal" method="post" action="post-and-get/product.php" enctype="multipart/form-data"> 
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" autocomplete="off" id="category"  name="category"  required="true" > 
                                                    <option> -- Please Select the Category -- </option> 
                                                    <?php
                                                    $CATEGORY = new ProductCategories(NULL);
                                                    foreach ($CATEGORY->all() as $key => $category) {
                                                        if ($category['id'] == $PRODUCT->category) {
                                                            ?>
                                                            <option selected="" value="<?php echo $category['id']; ?>" required="true" > <?php echo $category['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option  value="<?php echo $category['id']; ?>" required="true" > <?php echo $category['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line" id="sub_category_bar">
                                                <select class="form-control" autocomplete="off" id="sub_category"  name="sub_category"  required="true" > 
                                                    <option> -- Please Select the Sub Category -- </option> 
                                                    <?php
                                                    $SUBCAT = new SubCategory(NULL);
                                                    foreach ($SUBCAT->getSubCategoriesByCategory($PRODUCT->category) as $key => $sub_category) {
                                                        if ($sub_category['id'] == $PRODUCT->sub_category) {
                                                            ?>
                                                            <option selected="" value="<?php echo $sub_category['id']; ?>" required="true" > <?php echo $sub_category['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option  value="<?php echo $sub_category['id']; ?>" required="true" > <?php echo $sub_category['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <select class="form-control" autocomplete="off" id="brand"  name="brand"  required="true" > 
                                                    <option> -- Please Select the Brand -- </option> 
                                                    <?php
                                                    $BRAND = new Brand(NULL);
                                                    foreach ($BRAND->all() as $key => $brand) {
                                                        if ($brand['id'] == $PRODUCT->brand) {
                                                            ?>
                                                            <option selected="" value="<?php echo $brand['id']; ?>" required="true" > <?php echo $brand['name'] ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option  value="<?php echo $brand['id']; ?>" required="true" > <?php echo $brand['name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control"  value="<?php echo $PRODUCT->name; ?>"  name="name"  required="TRUE">
                                                <label class="form-label">Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="discount" class="form-control"  value="<?php echo $PRODUCT->discount; ?>"  name="discount"  min="0">
                                                <label class="form-label">Discount</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="unite" class="form-control"  value="<?php echo $PRODUCT->unite; ?>"  name="unite"  required="TRUE">
                                                <label class="form-label">Unit</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="price" class="form-control"  value="<?php echo $PRODUCT->price; ?>"  name="price"  required="TRUE" min="0">
                                                <label class="form-label">Price</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="filled-in chk-col-pink" type="checkbox" <?php if($PRODUCT->in_stock == 1) { echo 'checked'; } ?> name="in_stock" value="1" id="rememberme" />
                                            <label for="rememberme">In Stock</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="min_qty" class="form-control" value="<?php echo $PRODUCT->min_qty; ?>" autocomplete="off" name="min_qty" required="true" min="0" step="0.5">
                                                <label class="form-label">Min Quantity</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="number" id="max_qty" class="form-control" value="<?php echo $PRODUCT->max_qty; ?>" autocomplete="off" name="max_qty" required="true" min="0" step="0.5">
                                                <label class="form-label">Max Quantity</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">                                       
                                        <div class="form-group form-float">
                                            
                                            <input type="file" id="image" class="form-control" value="<?php echo $PRODUCT->image_name; ?>"  name="image">
                                                <img src="../upload/product-categories/sub-category/product/photos/<?php echo $PRODUCT->image_name; ?>"  class="  img img-responsive img-thumbnail"  alt="old image" width="20%" >
                                         
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" id="short_description" class="form-control" value="<?php echo $PRODUCT->short_description; ?>"  name="short_description">
                                                <label class="form-label">Short Description</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="description">Description</label>
                                        <div class="form-line">
                                            <textarea id="description" name="description" class="form-control" rows="5"><?php echo $PRODUCT->description; ?></textarea> 
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" id="oldImageName" value="<?php echo $PRODUCT->image_name; ?>" name="oldImageName"/>
                                        <input type="hidden" id="id" value="<?php echo $PRODUCT->id; ?>" name="id"/> 
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update" value="update">Save Changes</button>
                                    </div>
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
        <script src="js/admin-js/sub-category.js" type="text/javascript"></script>

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