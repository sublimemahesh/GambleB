<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include './auth.php';

$MEMBER = new Member($_SESSION["id"]);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$GROUP = new Group($id);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Group || GambleB</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="../image/png" sizes="32x32" href="image/favicon-32x32.png"> 
        <!-- Animation CSS -->
        <link rel="stylesheet" href="css/animate.css" type="text/css">  
        <!-- Font Css -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <!-- Bootstrap Css --> 
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="lib/datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css"/>
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
                <i class="fa fa-map-marker"></i> : Edit Group
            </div>

            <div class="row"> 
                <div class="col-md-8">
                    <div class="panel-box">
                        <form class="form-horizontal" id="group-form" method="post" action="" enctype="multipart/form-data"> 
                            <div class="row">
                                <div class="col-lg-3 col-md-3 form-control-label text-right">
                                    <label for="game">Game <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <select class="form-control" type="text" id="game" autocomplete="off" name="game">
                                                <option value=""  class="active light-c"> -- Please  Select Game -- </option>
                                                <?php
                                                $GAME = new Game(NULL);
                                                foreach ($GAME->all() as $key => $game) {
                                                    if ($GROUP->game == $game['id']) {
                                                        ?>
                                                        <option value="<?php echo $game['id']; ?>" selected=""><?php echo $game['name']; ?></option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="<?php echo $game['id']; ?>"><?php echo $game['name']; ?></option>
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
                                    <label for="end_date_time">End Date & Time <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <input type="text" id="end_date_time" class="form-control"  autocomplete="off" name="end_date_time" required="true" value="<?php echo $GROUP->end_date_time; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 form-control-label text-right">
                                    <label for="status">Status<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 p-bottom">
                                    <div class="form-group">
                                        <div class="form-line"> 
                                            <?php
                                            if ($GROUP->status == 1) {
                                                ?>
                                                <input type="checkbox" id="status" class="form-control" checked="checked" autocomplete="off" name="status" required="true" value="status">
                                                <?php
                                            } else {
                                                ?>
                                                <input type="checkbox" id="status" class="form-control" autocomplete="off" name="status" required="true" value="status">
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 form-control-label text-right"> 
                                </div>
                                <div class="col-lg-9  col-md-9 col-sm-9 col-xs-12 p-l-0"> 
                                    <input type="hidden" id="member" class="form-control"  autocomplete="off" name="member" required="true" value="<?php echo $MEMBER->id; ?>">
                                    <input type="hidden" id="id" class="form-control"  autocomplete="off" name="id" required="true" value="<?php echo $id; ?>">
                                    <input type="submit" name="btn-update" id="btn-update" class="btn btn-info" value="Update"/>
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
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="lib/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="js/custom.js" type="text/javascript"></script> 
        <script src="js/group.js" type="text/javascript"></script> 
        <script>
            $('#end_date_time').datetimepicker({
                format: 'Y/m/d H:i'
            });
        </script>
    </body>
</html>	 