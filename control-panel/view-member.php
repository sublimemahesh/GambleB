<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$MEMBER = new Member($id);
$COUNTRY = new Country($MEMBER->country);
?> 
<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>View Member</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />


        <script src="plugins/jquery/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

        <script src="js/order.js" type="text/javascript"></script>
        <!--<script src="../js/libs/html2canvas.min.js" type="text/javascript"></script>-->
        <!--<script src="'https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js'"></script>-->

    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>
        <section class="content">
            <div class="container-fluid"> 
                <!-- Manage Brand -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    View Member
                                </h2>
                                <ul class="header-dropdown">

                                </ul>
                            </div>
                            <div class="body">
                                <div id="content">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>Member ID</th>
                                            <td><?php echo '#' . $MEMBER->id; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td><?php echo $MEMBER->createdAt; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Full Name</th>
                                            <td><?php echo $MEMBER->name; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><?php echo $MEMBER->email; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td><?php echo $MEMBER->phone_number; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td><?php echo $MEMBER->address; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td><?php echo $COUNTRY->name; ?></td>
                                        </tr>

                                    </table>
                                </div>

                                <div  class="btn-back">
                                        <a href="manage-members.php" class="op-link btn btn-sm btn-info">Back</a>
                                    <?php
                                    if ($MEMBER->isActive == 1) {
                                        ?>
                                        <a href="#" class="suspend-member btn btn-sm btn-danger" data-id="<?php echo $MEMBER->id; ?>">Suspend</a>
                                        <?php
                                    } else if ($MEMBER->isActive == 0) {
                                        ?>
                                        <a href="#" class="active-member btn btn-sm btn-danger" data-id="<?php echo $MEMBER->id; ?>">Active</a>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Manage brand -->

            </div>
        </section>
        <div id="elementH"></div>

        <script src="plugins/bootstrap/js/bootstrap.js"></script>
        <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
        <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="plugins/node-waves/waves.js"></script>
        <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="js/pages/ui/dialogs.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/member.js" type="text/javascript"></script>

    </body>

</html>