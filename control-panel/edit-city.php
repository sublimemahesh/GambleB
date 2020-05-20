<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$CITY = new City($id);
?> 
﻿<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Edit City || Admin || Support Lanka</title>

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
        include '/navigation-and-header.php';

            ?>

            <section class="content">
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <div class="container-fluid"> 
                    <!-- Body Copy -->

                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <h2>
                                        Edit City
                                    </h2>
                                    <ul class="header-dropdown">
                                        <li class="">
                                            <a href="create-city.php?id=<?php echo $CITY->district; ?>">
                                                <i class="material-icons">list</i> 
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body row">
                                    <form class="form-horizontal col-sm-9 col-md-12" method="post" action="post-and-get/city.php" enctype="multipart/form-data"> 
                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                                <label for="district">District</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                <div class="form-group place-select">
                                                    <div class="form-line">
                                                        <label for="district" class="hidden-lg hidden-md">District</label>
                                                        <select class="form-control show-tick place-select1" type="text" id="district" autocomplete="off" name="district" disabled="true">
                                                            <option value="<?php $CITY->id ?>" class="active light-c">
                                                                <?php
                                                                $DIS = new District($CITY->district);
                                                                echo $DIS->name;
                                                                ?>
                                                            </option>
                                                            <?php foreach (District::all() as $key => $dist) {
                                                                ?>
                                                                <option value="<?php echo $dist['id']; ?>"><?php echo $dist['name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs form-control-label">
                                                <label for="name">Name</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label for="name" class="hidden-lg hidden-md">Name</label>
                                                        <input type="text" id="name" class="form-control" placeholder="Enter City name" autocomplete="off" name="name" value="<?php echo $CITY->name; ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-4">
                                                <input type="hidden" id="id" value="<?php echo $CITY->id; ?>" name="id"/>

                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="edit-city" value="submit">Save Changes</button>
                                            </div>
                                        </div>
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
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/demo.js"></script>
    <script src="js/add-new-ad.js" type="text/javascript"></script>

</body>

</html>