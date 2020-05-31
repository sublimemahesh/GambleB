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
$GAME = new Game($GROUP->game);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="shortcut icon" href="images/logo/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/logo/favicon.png" type="image/x-icon">

        <title><?php echo $GROUP->name; ?> || Groups || GambleB</title>

        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/magnific-popup.css" rel="stylesheet">
        <link href="assets/css/jquery-ui.css" rel="stylesheet">
        <link href="control-panel/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.css" rel="stylesheet">
        <link href="assets/css/owl.carousel.min.css" rel="stylesheet">
        <!-- Main css -->
        <link href="assets/css/main.css" rel="stylesheet">
        <link href="contact-form/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/dice-roll.css" rel="stylesheet" type="text/css"/>

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
        <section class="breadcrumb-area blue-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="site-breadcrumb">
                            <h2><?php echo $GAME->name; ?></h2>
                            <ul>
                                <li><a href="./">Home</a></li>
                                <li><a href="view-group.php?id=<?php echo $id; ?>"><?php echo $GROUP->name; ?></a></li>
                                <li><?php echo $GAME->name; ?></li>
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
                <input type="hidden" value="<?php echo $id; ?>" id="group" />
                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" id="member" />
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 " id="member-section">
                        <div class="inplay-details">

                            <?php
                            $members = GameSessionMembers::getMembersByGameSession($_SESSION['game_session']);
                            $GMSESSION = new GameSession($_SESSION['game_session']);
                            
                            if ($members) {
                                foreach ($members as $member) {
                                    $MEM = new Member($member['member']);
                                    $active = '';

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
                                            <?php
                                            
                                            if ($member['is_online'] == 0) {
                                                ?>
                                                <span>Left</span>
                                                <?php
                                            } elseif ($member['is_online'] == 1 && $GMSESSION->current_player === $member['sort']) {
                                                ?>
                                                <input id="toggle-rotate" class="bttn-small btn-fill btn-<?php echo $member['sort']; ?>" type ="button" value ="start">
                                                <?php
                                            } else {
                                                ?>
                                                <input id="toggle-rotate" class="bttn-small btn-fill btn-<?php echo $member['sort']; ?>" disabled type ="button" value ="start">
                                                <?php
                                            }
                                            ?>


                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <h5></h5>
                                <?php
                            }
                            ?>                     
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                        <div  class="button-panel">
                            <input id="toggle-rotate" class="bttn-small btn-fill" type ="button" value ="start">
                        </div>
                        <section class="container1">
                            <div class ="" id="cube">
                                <figure id="one" class="front">
                                    <div class="dot dot-center"></div>
                                </figure>
                                <figure id="two" class="back">

                                    <div class="dot dot-ul"></div>     
                                    <div class="dot dot-lr"></div>

                                </figure>
                                <figure id="three" class="right">
                                    <div class="dot dot-ul"></div>
                                    <div class="dot dot-center"></div>
                                    <div class="dot dot-lr"></div>
                                </figure>
                                <figure id="four" class="left">
                                    <div class="dot dot-ul"></div>
                                    <div class="dot dot-ur"></div>
                                    <div class="dot dot-ll"></div>
                                    <div class="dot dot-lr"></div>
                                </figure>
                                <figure id="five" class="top">
                                    <div class="dot dot-ul"></div>
                                    <div class="dot dot-ur"></div>
                                    <div class="dot dot-center"></div>
                                    <div class="dot dot-ll"></div>
                                    <div class="dot dot-lr"></div>
                                </figure>
                                <figure id="six" class="bottom">
                                    <div class="dot dot-ul"></div>
                                    <div class="dot dot-ur"></div>
                                    <div class="dot dot-lc"></div>
                                    <div class="dot dot-rc"></div>
                                    <div class="dot dot-ll"></div>
                                    <div class="dot dot-lr"></div>
                                </figure>
                            </div>
                        </section>

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
        <script src="control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
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
        <script src="js/game_session_members.js" type="text/javascript"></script>
        <script src="js/game-session.js" type="text/javascript"></script>
        <script src="js/dice-roll.js" type="text/javascript"></script>
    <!--test-->    
    </body>
</html>
