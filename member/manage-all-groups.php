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

        <title>All Groups || GambleB</title>

        <!-- Favicon Icon Css -->
        <link rel="icon" type="../image/png" sizes="32x32" href="image/favicon-32x32.png"> 
        <!-- Animation CSS -->
        <link rel="stylesheet" href="../css/animate.css" type="text/css">  
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


        <link href="../control-panel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                <i class="fa fa-map-marker"></i> : Manage All Groups
            </div>

            <div class="row"> 
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover data_table dataTable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th> 
                                    <th>Game</th> 
                                    <th>Member</th> 
                                    <th>Created At</th> 
                                    <th>End Date & Time</th>
                                    <th>Status</th>
                                    <th  class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $GROUP = new Group(NULL);
                                foreach ($GROUP->getGroupsByMember($MEMBER->id) as $key => $group) {
                                    $key++;
                                    ?>
                                    <tr id="row_<?php echo $group['id']; ?>" >
                                        <td><?php echo $key; ?></td>  
                                        <td>
                                            <?php
                                            $GAME = new Game($group['game']);
                                            echo $GAME->name;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $MEM = new Member($group['member']);
                                            echo $MEM->name;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $group['created_at']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $group['end_date_time']; ?>
                                        </td> 
                                        <td>
                                            <?php echo ucfirst($group['status']); ?>
                                        </td>  
                                        <td class="text-center" >
                                            <?php
                                            if (!GroupMember::checkMemberJoinedOrNot($group['id'], $MEMBER->id)) {
                                                ?>
                                                <a href="#"  class="join-group btn btn-sm btn-info" data-id="<?php echo $group['id']; ?>" member="<?php echo $MEMBER->id; ?>"> <i class="fa fa-sign-in"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                Joined
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>   
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th> 
                                    <th>Game</th> 
                                    <th>Member</th>
                                    <th>Created At</th> 
                                    <th>End Date & Time</th>
                                    <th>Status</th>
                                    <th  class="text-center">Options</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> 
            </div>  
        </div>
        <?php include './footer.php'; ?> 

        <!-- Jquery js -->
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="js/custom.js" type="text/javascript"></script> 

        <script src="../control-panel/plugins/jquery-datatable/jquery.dataTables.js"></script> 
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="js/data_tables.js" type="text/javascript"></script> 
        <script src="js/group.js" type="text/javascript"></script>


    </body>
</html>	 