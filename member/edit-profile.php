<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include './auth.php';

$MEMBER = new Member($_SESSION["id"]);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Edit Profile || GambleB</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="../image/png" sizes="32x32" href="image/favicon-32x32.png"> 
        <!-- Animation CSS -->
        <link rel="stylesheet" href="css/animate.css" type="text/css">  
        <!-- Font Css -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap Css --> 
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">

        <!-- main css --> 
        <link href="css/style.css" type="text/css" rel="stylesheet">
        <link href="css/responsive.css" type="text/css" rel="stylesheet">
        <link href="css/custom.css" type="text/css" rel="stylesheet">
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">

    </head>
    <body class="theme-2">
        <!-- LOADER -->
<!--        <div id="preloader">
            <div class="loading_wrap">
                <img src="../image/logo.jpg" alt="logo">
            </div>
        </div>-->
        <!-- LOADER -->

        <?php include './header.php'; ?>
        <div class="container">
            <div class="header-bar">
                <i class="fa fa-user-circle"></i> : Edit Profile 
            </div>
            <?php
            if (isset($_GET['status'])) {
                if (isset($_GET['status']) == 'complate') {
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Inactive!</strong> Your account is not active and please complete the below details .
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="row"> 
                <div class="col-md-12">
                    <div class="panel-box">
                        <div class="row"> 
                            <div class="col-md-8">
                                <form class="form-horizontal" id="member-form" method="post" action="" enctype="multipart/form-data"> 

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->name)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" id="name" class="form-control <?php echo $class; ?>"  autocomplete="off" name="name" required="true" value="<?php echo $MEMBER->name; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="phone">Phone No <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->phone_number)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" id="phone" class="form-control <?php echo $class; ?>"  autocomplete="off" name="phone" required="true" value="<?php echo $MEMBER->phone_number; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs form-control-label text-right">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->email)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?>  
                                                    <input type="text" id="email" class="form-control <?php echo $class; ?>"  autocomplete="off" name="email" required="true" value="<?php echo $MEMBER->email; ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="country">Country <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->country)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <select class="form-control <?php echo $class; ?>" type="text" id="country" autocomplete="off" name="country">
                                                        <option value=""  class="active light-c"> -- Please  Select Your Country -- </option>
                                                        <?php
                                                        $COUNTRY = new Country(NULL);
                                                        foreach ($COUNTRY->all() as $key => $country) {
                                                            if ($MEMBER->country == $country['id']) {
                                                                ?>
                                                                <option value="<?php echo $country['id']; ?>" selected=""><?php echo $country['name']; ?></option>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $country['id']; ?>"  ><?php echo $country['name']; ?></option>

                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="address">Address <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->address)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" name="address" class="form-control <?php echo $class; ?>" id="address" value="<?php echo $MEMBER->address; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="profile_image">Profile Image<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($MEMBER->image_name)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="file" name="profile_image" class="form-control <?php echo $class; ?>" id="profile_image"> 
                                                    <input type="hidden" name="profile_image_ex"  id="profile_image_ex" value="<?php echo $MEMBER->image_name; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">  
                                                    <a href="uploads/profile_image/<?php echo $MEMBER->image_name; ?>" target="_blank" class="btn btn-lg btn-info">
                                                        <i class="fa fa-image"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right"> 
                                        </div>
                                        <div class="col-lg-9  col-md-9 col-sm-12 col-xs-12 p-l-0">
                                            <input type="hidden" name="id" id="customer" value="<?php echo $MEMBER->id; ?>">
                                            <input type="submit" name="update" id="btn-update" class="btn btn-info" value="Update Details"/>
                                            <img src="img/loading.gif" id="update-loading"/>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div> 
                    </div> 
                </div> 
                <div id="chart_div"></div>
            </div>
        </div>
        <?php include './footer.php'; ?> 

        <!-- Jquery js -->
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="js/custom.js" type="text/javascript"></script> 
        <script src="js/city.js" type="text/javascript"></script> 
        <script src="js/member.js" type="text/javascript"></script> 

    </body>
</html>	 