<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/online-status.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$MEMBER = new Member($_SESSION['id']);
$GROUP = new Group($id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="refresh" content="10">

        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

        <title><?php echo $GROUP->name; ?> || Groups || GambleB</title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/magnific-popup.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.css" rel="stylesheet">
        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
        <!-- Main css -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="contact-form/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div><!--/Preloader -->

        <?php
        include './header.php';
        ?>

        <!--breadcrumb area-->
        <section class="breadcrumb-area blue-overlay" style="background: url('assets/images/banner/3.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="site-breadcrumb">
                            <h2><?php echo $GROUP->name; ?></h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><a href="groups.php">All Groups</a></li>
                                <li><?php echo $GROUP->name; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/breadcrumb area-->

        <!--Play now Section-->
        <section class="section-padding blue-bg shaded-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="section-title cl-white">
                            <h4>Group Members</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="inplay-details">
                            <?php
                            $groupmembers = GroupMember::getAllMembersByGroup($id);
                            if ($groupmembers) {
                                foreach ($groupmembers as $member) {
                                    $MEM = new Member($member['member']);
                                    $active = '';
                                    if ($member['is_online'] == 1) {
                                        $active = 'active';
                                    }
                                    if ($MEM->id == $_SESSION['id']) {
                                        $name = 'You';
                                    } else {
                                        $name = $MEM->name;
                                    }
                                    ?>
                                    <div class="single-inplay">
                                        <div class="img">
                                            <?php
                                            if ($MEM->image_name) {
                                                ?>
                                                <img src="upload/member/profile_image/<?php echo $MEM->image_name; ?>" class="img-circle" alt="">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="images/user.png" class="img-circle" alt="">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text">
                                            <h4><?php echo $name; ?></h4>
                                        </div>
                                        <div class="ball active-ball <?php echo $active; ?>">
                                            <a href="#"></a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <h5>No any members in this group.</h5>
                                <?php
                            }
                            ?>                     
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                        <img src="assets/images/game-inplay.jpg" alt="">
                    </div>
                </div>
            </div>
        </section><!--/Play now Section-->

        <?php
        include './footer.php';
        ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/jquery-migrate.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <script src="assets/js/popper.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/magnific-popup.min.js"></script>
        <script src="assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="assets/js/isotope.pkgd.min.js"></script>
        <script src="assets/js/waypoints.min.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/scrollUp.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>
