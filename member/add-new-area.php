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
                <i class="fa fa-map-marker"></i> : Add New Area
            </div>

            <div class="row"> 
                <div class="col-md-8">
                    <div class="panel-box">
                        <form class="form-horizontal" id="dealer-form" method="post" action="" enctype="multipart/form-data"> 


                            <div class="row">
                                <div class="col-lg-3 col-md-3 form-control-label text-right">
                                    <label for="district">District <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <select class="form-control" type="text" id="district" autocomplete="off" name="district">
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
                                            <select class="form-control" autocomplete="off" type="text" id="city" autocomplete="off" name="city" required="TRUE">
                                                <option value=""  class="active light-c"> -- Please  Select Your City -- </option>
                                                <?php
                                                $CITY = new City(NULL);
                                                foreach ($CITY->GetCitiesByDistrict($DEALER->district) as $city) {
                                                    ?>
                                                    <option value="<?php echo $city['id'] ?>" ><?php echo $city['name']; ?>  </option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-3 form-control-label text-right"> 
                                </div>
                                <div class="col-lg-9  col-md-9 col-sm-9 col-xs-12 p-l-0"> 
                                    <input type="submit" name="btn-save" id="btn-save" class="btn btn-info" value="Add New Area"/>
                                </div>
                            </div>

                        </form>
                    </div>

                </div> 
            </div> 
            <div id="chart_div"></div>
        </div>
        <?php include './footer.php'; ?> 

        <!-- Jquery js -->
        <script src="../js/jquery.min.js" type="text/javascript"></script>

        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="../js/custom.js" type="text/javascript"></script> 
        <script src="js/city.js" type="text/javascript"></script> 
        <script src="js/dealer_area.js" type="text/javascript"></script> 
   
        <?php
        $DEALER = new Dealer($_SESSION["d_id"]);

        $result = $DEALER->checkEmptyData();
        if ($result != 0) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.location.replace("edit-profile.php?status=complate");
                });
            </script>
            <?php
        }

        $agreement = $DEALER->checkAgreement();

        if ($agreement == 0) {
            ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    window.location.replace("agreement.php?status=complate");
                });
            </script>
            <?php
        }
        ?>  
    </body>
</html>	 