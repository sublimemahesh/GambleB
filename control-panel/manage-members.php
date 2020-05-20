<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Manage Members </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    </head>

    <body class="theme-red">
        <?php
        include './navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid"> 
                <!-- Manage Countrys -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Manage Members
                                </h2>
                                <ul class="header-dropdown">
                                    <li>
                                        <a href="create-member.php">
                                            <i class="material-icons">add</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <div>
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th> 
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Country</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th> 
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Country</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Options</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $MEMBER = new Member(NULL);
                                                foreach ($MEMBER->all() as $key => $member) {
                                                    $key++;
                                                    ?>
                                                    <tr id="div_<?php echo $member['id']; ?>">
                                                        <td><?php echo $key; ?></td> 
                                                        <td><?php echo $member['name']; ?></td> 
                                                        <td><?php echo $member['email']; ?></td> 
                                                        <td><?php echo $member['phone_number']; ?></td> 
                                                        <td>
                                                            <?php
                                                            $COUNTRY = new Country($member['country']);
                                                            echo $COUNTRY->name
                                                            ?>
                                                        </td> 
                                                        <td><?php echo $member['address']; ?></td> 
                                                        <td>
                                                            <?php
                                                            if ($member['is_active'] == 1) {
                                                                ?>
                                                            Active
                                                                    <?php
                                                            } else if ($member['is_active'] == 0) {
                                                                ?>
                                                                Suspend
                                                                    <?php
                                                            }
                                                            ?>
                                                            
                                                        </td>
                                                        <td>  
                                                            <a href="view-member.php?id=<?php echo $member['id']; ?>" title="View Country"> <button class="glyphicon glyphicon-eye-open edit-btn"></button></a> |  
                                                            <?php
                                                            if ($member['is_active'] == 1) {
                                                                ?>
                                                            <a href="#"  class="suspend-member" data-id="<?php echo $member['id']; ?>"> <button class="glyphicon glyphicon-remove-sign delete-btn" title="Suspend"></button></a>
                                                                <?php
                                                            } else if ($member['is_active'] == 0) {
                                                                ?>
                                                                <a href="#"  class="active-member" data-id="<?php echo $member['id']; ?>"> <button class="glyphicon glyphicon-check arrange-btn" title="Active"></button></a>
                                                                <?php
                                                            }
                                                            ?>
                                                            
                                                        </td>
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
                    </div>

                </div>
        </section>

        <script src="plugins/jquery/jquery.min.js"></script>
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
        <script src="plugins/sweetalert/sweetalert.min.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/pages/tables/jquery-datatable.js"></script>
        <script src="js/demo.js"></script>
        <script src="js/member.js" type="text/javascript"></script>
    </body>

</html> 