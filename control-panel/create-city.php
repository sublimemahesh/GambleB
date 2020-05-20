<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include_once(dirname(__FILE__) . '/auth.php');

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$DISTRICT = new District($id)
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Add New City </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <!-- Bootstrap Spinner Css -->
        <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">
        <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
    </head>

    <body class="theme-red">
        <?php
        include 'navigation-and-header.php';
        ?>

        <section class="content">
            <div class="container-fluid">  
                <?php
                $vali = new Validator();

                $vali->show_message();
                ?>
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Create City</h2>
                                <ul class="header-dropdown">
                                    <li class="">
                                        <a href="manage-district.php">
                                            <i class="material-icons">list</i> 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                <form class=""  method="post" action="post-and-get/city.php" enctype="multipart/form-data"> 

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="district">District</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 " id="p-margin-0">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text"   class="form-control" value="<?php echo $DISTRICT->name ?>" autocomplete="off"  disabled="true">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">
                                            <label for="name">Name</label>
                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 " id="p-margin-0">
                                            <div class="form-group">
                                                <div class="form-line"> 
                                                    <input type="text" id="name" class="form-control"   autocomplete="off" name="name" >
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 hidden-sm hidden-xs form-control-label">

                                        </div>
                                        <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12 p-bottom">
                                            <div class="form-group">
                                                <input type="hidden" id="id" value="<?php echo $DISTRICT->id; ?>" name="id"/>
                                                <input type="submit" name="create" class="btn btn-primary m-t-15 waves-effect" value="Add City"/>

                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                <table class="table table-bordered table-striped table-hover" id="tb-city">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th> 
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $CITY = new City(NULL);
                                        $CITY = $CITY->GetCitiesByDistrict($id);
                                        if (count($CITY) > 0) {
                                            foreach ($CITY as $key => $city) {
                                                $key++;
                                                ?>
                                                <tr id="row_<?php echo $city['id']; ?>">
                                                    <td><?php echo $key; ?></td> 

                                                    <td><?php echo $city['name']; ?></td>

                                                    <td> 

                                                        <a href="edit-city.php?id=<?php echo $city['id']; ?>" title="Edit District"> <button class="glyphicon glyphicon-pencil edit-btn"></button></a> |  
                                                        <a href="#"  class="delete-city" data-id="<?php echo $city['id']; ?>"> <button class="glyphicon glyphicon-trash delete-btn"></button></a>

                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th> 
                                            <th>Option</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.js"></script> 
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="plugins/node-waves/waves.js"></script>
    <script src="plugins/sweetalert/sweetalert.min.js"></script>
 
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
    <script src="js/pages/ui/dialogs.js"></script>
    <script src="js/demo.js"></script>
    <script src="delete/js/city.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#tb-city').DataTable({
                "order": [[1, "asc"]]
            });
        });
    </script>

</body>

</html>