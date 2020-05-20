<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Create Customer</title>
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
                                <h2>Create Customer</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-customer.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class="form-horizontal"  method="post" action="post-and-get/customer.php" enctype="multipart/form-data"> 

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" id="name" class="form-control"  autocomplete="off" name="name" required="true" placeholder="Enter the Name.">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" id="email" class="form-control"  autocomplete="off" name="email" required="true" placeholder="Enter the Email.">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="password" id="password" class="form-control"  autocomplete="off" name="password" required="true" placeholder="Enter the Password.">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="phone_number">Mobile</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" id="phone_number" class="form-control"  autocomplete="off" name="phone_number" required="true" placeholder="Enter the Mobile Number.">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="district">District</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <select class="form-control" type="text" id="district" autocomplete="off" name="district">
                                                        <option class="active light-c"> -- Please  Select Your District -- </option>
                                                        <?php
                                                        $DISTRICT = new District(NULL);
                                                        foreach ($DISTRICT->all() as $key => $district) {
                                                            ?>
                                                            <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>

                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="city">City</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <select class="form-control" autocomplete="off" type="text" id="city-bar" autocomplete="off" name="city" required="TRUE">
                                                        <option value=""> -- Please Select a District First -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter he Address."> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label"> 
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <input type="submit" name="create" class="btn btn-primary m-t-15 waves-effect" value="create"/>

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
        <script src="js/admin-js/city.js" type="text/javascript"></script>

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