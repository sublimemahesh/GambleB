<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/online-status.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


        <link rel="shortcut icon" href="images/logo/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/logo/favicon.png" type="image/x-icon">

        <title>All Groups || GambleB</title>

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
                            <h2>All Groups</h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li>All Groups</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--/breadcrumb area-->

        <section class="section-padding blue-bg shaded-bg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 mb-30">
                        <div class="winner-list table-responsive">
                            <table class="table table-dark table-hover table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Member</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach (Group::getActiveGroup() as $key => $group) {
                                        $MEM = new Member($group['member']);
                                        $key++;
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $key; ?></th>
                                            <td class="cl-mint"><?php echo $group['name']; ?></td>
                                            <td class="cl-yellow">
                                                <?php
                                                if ($MEM->image_name) {
                                                    ?>
                                                <img src="upload/member/profile_image/<?php echo $MEM->image_name; ?>" alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="images/user.png" alt="">
                                                    <?php
                                                }
                                                ?>
                                                <?php echo $MEM->name; ?></td>
                                            <td class="cl-green"><?php echo $group['end_date_time']; ?></td>
                                            <td><a href="view-group.php?id=<?php echo $group['id']; ?>" class="bttn-small btn-fill">View</a></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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