<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include './auth.php';

$DEALER = new Dealer($_SESSION["d_id"]);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Cash on Delivery - Online Shopping Store</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="../image/png" sizes="32x32" href="image/favicon-32x32.png"> 
        <!-- Animation CSS -->
        <link rel="stylesheet" href="../css/animate.css" type="text/css">  
        <!-- Font Css -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap Css --> 
        <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">

        <!-- main css --> 
        <link href="../css/style.css" type="text/css" rel="stylesheet">
        <link href="../css/responsive.css" type="text/css" rel="stylesheet">
        <link href="css/custom.css" type="text/css" rel="stylesheet">
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">

    </head>
    <body class="theme-2">
        <!-- LOADER -->
        <div id="preloader">
            <div class="loading_wrap">
                <img src="../image/logo.jpg" alt="logo">
            </div>
        </div>
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
                                <form class="form-horizontal" id="dealer-form" method="post" action="" enctype="multipart/form-data"> 

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->name)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" id="name" class="form-control <?php echo $class; ?>"  autocomplete="off" name="name" required="true" value="<?php echo $DEALER->name; ?>">
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
                                                    if (empty($DEALER->phone)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" id="phone" class="form-control <?php echo $class; ?>"  autocomplete="off" name="phone" required="true" value="<?php echo $DEALER->phone; ?>">
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
                                                    if (empty($DEALER->email)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?>  
                                                    <input type="text" id="email" class="form-control <?php echo $class; ?>"  autocomplete="off" name="email" required="true" value="<?php echo $DEALER->email; ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="district">District <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->district)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <select class="form-control <?php echo $class; ?>" type="text" id="district" autocomplete="off" name="district">
                                                        <option value=""  class="active light-c"> -- Please  Select Your District -- </option>
                                                        <?php
                                                        $DISTRICT = new District(NULL);
                                                        foreach ($DISTRICT->all() as $key => $district) {
                                                            if ($DEALER->district == $district['id']) {
                                                                ?>
                                                                <option value="<?php echo $district['id']; ?>" selected=""><?php echo $district['name']; ?></option>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo $district['id']; ?>"  ><?php echo $district['name']; ?></option>

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
                                            <label for="city">City <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->city)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?>

                                                    <select class="form-control <?php echo $class; ?>" autocomplete="off" type="text" id="city" autocomplete="off" name="city" required="TRUE">
                                                        <option value=""  class="active light-c"> -- Please  Select Your City -- </option>
                                                        <?php
                                                        $CITY = new City(NULL);
                                                        foreach ($CITY->GetCitiesByDistrict($DEALER->district) as $city) {
                                                            if ($city['id'] == $DEALER->city) {
                                                                ?>
                                                                <option value="<?php echo $city['id'] ?>" selected=""><?php echo $city['name']; ?>  </option>
                                                            <?php } else {
                                                                ?>
                                                                <option value="<?php echo $city['id'] ?>" ><?php echo $city['name']; ?>  </option>
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
                                                    if (empty($DEALER->address)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" name="address" class="form-control <?php echo $class; ?>" id="address" value="<?php echo $DEALER->address; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="nic">NIC Number <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->nic)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" name="nic" class="form-control <?php echo $class; ?>" id="nic" value="<?php echo $DEALER->nic; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="nic_fr_photo">NIC Photo Front<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->nic_fr_photo)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="file" name="nic_fr_photo" class="form-control <?php echo $class; ?>" id="nic_fr_photo"> 
                                                    <input type="hidden" name="nic_fr_photo_ex"  id="nic_fr_photo_ex" value="<?php echo $DEALER->nic_fr_photo; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">  
                                                    <a href="uploads/nic/<?php echo $DEALER->nic_fr_photo; ?>" target="_blank" class="btn btn-lg btn-info">
                                                        <i class="fa fa-image"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="nic_bk_photo">NIC Photo Back<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->nic_bk_photo)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="file" name="nic_bk_photo" class="form-control <?php echo $class; ?>" id="nic_bk_photo"> 
                                                    <input type="hidden" name="nic_bk_photo_ex"  id="nic_bk_photo_ex" value="<?php echo $DEALER->nic_bk_photo; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">  
                                                    <a href="uploads/nic/<?php echo $DEALER->nic_bk_photo; ?>" target="_blank" class="btn btn-lg btn-info">
                                                        <i class="fa fa-image"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="business_name">Business Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->business_name)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="text" name="business_name" class="form-control <?php echo $class; ?>" id="business_name" value="<?php echo $DEALER->business_name; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="br_number">BR Number<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->br_number)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?>
                                                    <input type="text" name="br_number" class="form-control <?php echo $class; ?>" id="br_number" value="<?php echo $DEALER->br_number; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 form-control-label text-right">
                                            <label for="br_copy">BR Copy<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-10 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <?php
                                                    $class = '';
                                                    if (empty($DEALER->br_copy)) {
                                                        $class = 'border-danger';
                                                    }
                                                    ?> 
                                                    <input type="file" name="br_copy" class="form-control <?php echo $class; ?>" id="br_copy"> 
                                                    <input type="hidden" name="br_copy_ex"  id="br_copy_ex" value="<?php echo $DEALER->br_copy; ?>"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-bottom">
                                            <div class="form-group">
                                                <div class="form-line">  
                                                    <a href="uploads/br/<?php echo $DEALER->br_copy; ?>" target="_blank" class="btn btn-lg btn-info">
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
                                            <input type="hidden" name="id" id="customer" value="<?php echo $DEALER->id; ?>">
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
        <script src="../js/jquery.min.js" type="text/javascript"></script>

        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="../js/custom.js" type="text/javascript"></script> 
        <script src="js/city.js" type="text/javascript"></script> 
        <script src="js/dealer.js" type="text/javascript"></script> 

    </body>
</html>	 