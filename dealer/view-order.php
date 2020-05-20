<?php
include_once(dirname(__FILE__) . '/../class/include.php');
include './auth.php';

$DEALER = new Dealer($_SESSION["d_id"]);
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$ORDER = new Order($id);
$CUSTOMER = new Customer($ORDER->member);
$DISTRICT = new District($ORDER->district);
$CITY = new City($ORDER->city);
$ORDER_PRODUCT = OrderProduct::getOrdersById($id);
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
        <link href="../control-panel/plugins/sweetalert/sweetalert.css" type="text/css" rel="stylesheet">


        <link href="../control-panel/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

        <link href="css/custom.css" type="text/css" rel="stylesheet">

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
                <i class="fa fa-map-marker"></i> : View Order - #<?php echo $id; ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-box">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>Order ID</th>
                                        <td><?php echo '#' . $ORDER->id; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ordered At</th>
                                        <td><?php echo $ORDER->orderedAt; ?></td>
                                    </tr>
                                    <?php
                                    if ($ORDER->deliveryStatus == 1) {
                                        ?>
                                        <tr>
                                            <th>Confirmed At</th>
                                            <td><?php echo $ORDER->deliveredAt; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if ($ORDER->deliveryStatus == 2) {
                                        ?>
                                        <tr>
                                            <th>Confirmed At</th>
                                            <td><?php echo $ORDER->deliveredAt; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Completed At</th>
                                            <td><?php echo $ORDER->completedAt; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    if ($ORDER->status == 0) {
                                        ?>
                                        <tr>
                                            <th>Canceled At</th>
                                            <td><?php echo $ORDER->canceledAt; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <?php
                                            if ($ORDER->status == 0) {
                                                echo 'Canceled';
                                            } else if ($ORDER->deliveryStatus == 0) {
                                                echo 'Pending';
                                            } else if ($ORDER->deliveryStatus == 1) {
                                                echo 'Confirmed';
                                            } else if ($ORDER->deliveryStatus == 2) {
                                                echo 'Completed';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td><?php echo $CUSTOMER->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Contact Number</th>
                                        <td><?php echo $ORDER->contactNo1; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Additional Contact Number</th>
                                        <td><?php echo $ORDER->contactNo2; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $ORDER->address; ?></td>
                                    </tr>
                                    <tr>
                                        <th>District</th>
                                        <td><?php echo $DISTRICT->name; ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?php echo $CITY->name; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover" id="product-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Product</th>
                                            <th class="text-right">Unit Price</th>                               
                                            <th class="text-right">Qty</th>                               
                                            <th class="text-right">Amount (Rs)</th>                       
                                            <th class="text-center">Options</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php
                                        $total = 0;
                                        foreach ($ORDER_PRODUCT as $key => $products) {
                                            $key++;
                                            $ORDER = new Order($products['order']);
                                            $PRODUCT = new Product($products['product']);
                                            $total = $total + $products['amount'];
                                            ?>
                                            <tr id="row_<?php echo $products['id']; ?>">
                                                <td><?php echo $key; ?></td> 
                                                <td id="proid_<?php echo $products['id']; ?>"><?php echo $PRODUCT->id; ?></td> 
                                                <td id="pro_<?php echo $products['id']; ?>"><?php echo $PRODUCT->name; ?></td>  
                                                <td id="price_<?php echo $products['id']; ?>" class="text-right"><?php echo number_format(($products['amount'] / $products['qty']), 2); ?></td> 
                                                <td id="qty_<?php echo $products['id']; ?>" class="text-right"><?php echo $products['qty']; ?></td> 
                                                <td id="amount_<?php echo $products['id']; ?>" class="text-right"><?php echo $products['amount']; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-pn-delete btn btn-sm btn-danger" id="<?php echo $products['id']; ?>">
                                                        <i class="fa fa-trash-o"></i>
                                                    </div>
                                                    <div class="btn-pn-edit btn btn-sm btn-info" id="<?php echo $products['id']; ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>   
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5"class="text-right">Product Total</th>                              
                                            <th class="text-right"><?php echo number_format($total, 2); ?></th>                       
                                            <th class="text-center">
                                                <div class="btn btn-sm btn-success" id="btn-pn-add" order-id="<?php echo $ORDER->id; ?>">
                                                    <i class="fa fa-plus"></i> Add New 
                                                </div>
                                            </th>     
                                        </tr>
                                    </tfoot>
                                </table>
                                <div  class="btn-back">
                                    <?php
                                    if ($ORDER->deliveryStatus == 0) {
                                        ?>
                                        <a href="#" data-id="<?php echo $ORDER->id; ?>" dealer="<?php echo $DEALER->id; ?>" class="btn btn-success" id="confirm-order">Confirm Order</a>
                                        <?php
                                    } else if ($ORDER->deliveryStatus == 1) {
                                        ?>
                                        <a href="#" data-id="<?php echo $ORDER->id; ?>" class="btn btn-success" id="complete-order">Complete Order</a>
                                        <a href="#" data-id="<?php echo $ORDER->id; ?>" class="btn btn-danger" id="cancle-order">Cancel Order</a>
                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="add-new-pro-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Product</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group"> 
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Enter Product Code" id="product_code">
                                    </div>
                                    <div class="col">
                                        <div class="btn btn-primary" id="btn_get_product">Search Product</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-responsive" style="width: 100%">
                                            <tr>
                                                <td>Code</td>
                                                <td>: </td>
                                                <td id="td_p_code"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>: </td>
                                                <td id="td_p_name"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Unite</td>
                                                <td>: </td>
                                                <td id="td_p_unite"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>: </td>
                                                <td>
                                                    <input type="number"  id="td_p_price" class="text-right td-cal-tot"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td>: </td>
                                                <td>
                                                    <input type="number"  id="td_p_quantity" class="text-right td-cal-tot" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>: </td>
                                                <td id="td_p_total" class="text-right">00.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="order_id" value="<?php echo $ORDER->id; ?>"/>
                            <input type="hidden" id="product_id"/>
                            <input type="hidden" id="las_id"/>
                            <button type="button" class="btn btn-primary" id="save_product">Save Product</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="edit-pro-modal" class="modal fade" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">  
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-responsive">
                                            <tr>
                                                <td style="width: 45%">Code</td>
                                                <td style="width: 5%">: </td>
                                                <td id="ed_p_code" style="width: 50%"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td>: </td>
                                                <td id="ed_p_name"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Unite</td>
                                                <td>: </td>
                                                <td id="ed_p_unite"> -- </td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>: </td>
                                                <td>
                                                    <input type="number"  id="ed_p_price" class="text-right ed-cal-tot"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td>: </td>
                                                <td>
                                                    <input type="number"  id="ed_p_quantity" class="text-right ed-cal-tot" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td>: </td>
                                                <td id="ed_p_total" class="text-right">00.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit_pro_id"/>
                            <button type="button" class="btn btn-primary" id="edit_product">Save Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include './footer.php'; ?> 

        <!-- Jquery js -->
        <script src="../js/jquery.min.js" type="text/javascript"></script>

        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../control-panel/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>

        <!-- Custom css -->
        <script src="../js/custom.js" type="text/javascript"></script>  
        <script src="js/confirm-order.js" type="text/javascript"></script>
        <script src="js/order-products.js" type="text/javascript"></script> 

        <script src="../control-panel/plugins/jquery-datatable/jquery.dataTables.js"></script> 
        <script src="../control-panel/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="js/data_tables.js" type="text/javascript"></script>    
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