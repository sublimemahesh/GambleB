<?php

/**
 * Description of Order
 *
 * @author U s E r ¨
 */
class Order {

    public $id;
    public $orderedAt;
    public $member;
    public $address;
    public $city;
    public $contactNo1;
    public $contactNo2;
    public $district;
    public $amount;
    public $productTotal;
    public $deliveryCharges;
    public $orderNote;
    public $status;
    public $paymentStatusCode;
    public $statusCode;
    public $deliveryStatus;
    public $deliveredAt;
    public $completedAt;
    public $canceledAt;
    public $dealer;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT *  FROM `orders` WHERE `id`='" . $id . "'";

            $db = new Database();

            $result = mysql_fetch_assoc($db->readQuery($query));

            $this->id = $result['id'];
            $this->orderedAt = $result['ordered_at'];
            $this->member = $result['member'];
            $this->address = $result['address'];
            $this->city = $result['city'];
            $this->contactNo1 = $result['contact_no_1'];
            $this->contactNo2 = $result['contact_no_2'];
            $this->district = $result['district'];
            $this->amount = $result['amount'];
            $this->productTotal = $result['product_total'];
            $this->deliveryCharges = $result['delivery_charges'];
            $this->orderNote = $result['order_note'];
            $this->status = $result['status'];
            $this->paymentStatusCode = $result['payment_status_code'];
            $this->statusCode = $result['status_code'];
            $this->deliveryStatus = $result['delivery_status'];
            $this->deliveredAt = $result['delivered_at'];
            $this->completedAt = $result['completed_at'];
            $this->canceledAt = $result['canceled_at'];
            $this->dealer = $result['dealer'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `orders` ("
                . "`ordered_at`,"
                . "`member`,"
                . "`address`,"
                . "`city`,"
                . "`contact_no_1`,"
                . "`contact_no_2`,"
                . "`district`,"
                . "`amount`,"
                . "`product_total`,"
                . "`delivery_charges`,"
                . "`order_note`,"
                . "`status`,"
                . "`payment_status_code`,"
                . "`delivery_status`,"
                . "`delivered_at`,"
                . "`completed_at`,"
                . "`canceled_at`,"
                . "`dealer`) VALUES  ("
                . "'" . $this->orderedAt . "', "
                . "'" . $this->member . "', "
                . "'" . $this->address . "', "
                . "'" . $this->city . "', "
                . "'" . $this->contactNo1 . "', "
                . "'" . $this->contactNo2 . "', "
                . "'" . $this->district . "', "
                . "'" . $this->amount . "', "
                . "'" . $this->productTotal . "', "
                . "'" . $this->deliveryCharges . "', "
                . "'" . $this->orderNote . "', "
                . "'" . $this->status . "', "
                . "'" . $this->paymentStatusCode . "', "
                . "'" . $this->deliveryStatus . "', "
                . "'" . $this->deliveredAt . "', "
                . "'" . $this->completedAt . "', "
                . "'" . $this->canceledAt . "', "
                . "'" . $this->dealer . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $last_id;
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `orders` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByDateRange($from, $to, $status) {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `status`='1' AND (`ordered_at` BETWEEN '" . $from . "' AND '" . $to . "' OR `ordered_at` LIKE '%" . $to . "%')";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByCustomer($customer) {

        $query = "SELECT * FROM `orders` WHERE `member`='" . $customer . "' ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getUnpaidOrdersByDateRange($from, $to) {

        $query = "SELECT * FROM `orders` WHERE `status`='0' AND (`ordered_at` BETWEEN '" . $from . "' AND '" . $to . "' OR `ordered_at` LIKE '%" . $to . "%') ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getPaidOrders() {

        $query = "SELECT * FROM `orders` WHERE `status`='1' ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function updateResponse($id, $status) {

        $query = "UPDATE `orders` SET "
                . "`status` ='" . $status . "' "
                . " WHERE `id` = '" . $id . "'";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $this->deleteOrderProducts();

        $query = 'DELETE FROM `orders` WHERE id="' . $this->id . '"';


        $db = new Database();
        return $db->readQuery($query);
    }

    public function deleteOrderProducts() {

        $ORDER_PRODUCT = new OrderProduct(NULL);

        $allOrderProducts = $ORDER_PRODUCT->getOrdersById($this->id);

        foreach ($allOrderProducts as $order_products) {

            $ORDER_PRODUCT_OBJ = new OrderProduct($order_products["id"]);

            $ORDER_PRODUCT_OBJ->delete();
        }
    }

    public function getLastID() {

        $query = "SELECT `id` FROM `orders` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysql_fetch_assoc($db->readQuery($query));

        return $result['id'];
    }

    function updatePaymentStatusCodeAndStatus() {

        $query = "UPDATE  `orders` SET "
                . "`payment_status_code` ='" . $this->paymentStatusCode . "', "
                . "`status_code` ='" . $this->statusCode . "', "
                . "`status` ='" . $this->status . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function updatePaymentStatusCode() {

        $query = "UPDATE  `orders` SET "
                . "`payment_status_code` ='" . $this->paymentStatusCode . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function markAsDelivered() {
        date_default_timezone_set('Asia/Colombo');
        $deliveredAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
                . "`delivery_status` ='1', "
                . "`delivered_at` ='" . $deliveredAt . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function markAsCompleted() {
        date_default_timezone_set('Asia/Colombo');
        $completedAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
                . "`delivery_status` ='2', "
                . "`completed_at` ='" . $completedAt . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function markAsCancled() {
        date_default_timezone_set('Asia/Colombo');
        $completedAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
                . "`delivery_status` ='3', "
                . "`completed_at` ='" . $completedAt . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function cancelOrder() {
        date_default_timezone_set('Asia/Colombo');
        $canceledAt = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
                . "`status` ='0', "
                . "`canceled_at` ='" . $canceledAt . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function assignDealer() {
        date_default_timezone_set('Asia/Colombo');
        $confirmed_at = date('Y-m-d H:i:s');
        $query = "UPDATE  `orders` SET "
                . "`dealer` ='" . $this->dealer . "', "
                . "`delivery_status` ='1', "
                . "`delivered_at` ='" . $confirmed_at . "' "
                . " WHERE `id` = '" . $this->id . "'  ";
        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteOrder() {

        $query = 'DELETE FROM `orders` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function getPaymentStatusCode($order) {

        $query = "SELECT `payment_status_code` FROM `orders` WHERE `id` = $order";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result["payment_status_code"];
    }

    public function getOrdersByDeliveryStatusDescending($status) {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `payment_status_code` != 4 AND `status`='1' ORDER BY `id` DESC ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrdersByDeliveryStatus($status) {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `status`='1'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCanceledOrders() {

        $query = "SELECT * FROM `orders` WHERE `status`='0'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getRefundOrders() {

        $query = "SELECT * FROM `orders` WHERE `payment_status_code`='4'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function createOrder() {

        date_default_timezone_set('Asia/Colombo');
        $orderedAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `orders` ("
                . "`ordered_at`,"
                . "`member`,"
                . "`address`,"
                . "`city`,"
                . "`contact_no_1`,"
                . "`contact_no_2`,"
                . "`district`,"
                . "`amount`,"
                . "`order_note`,"
                . "`status`) VALUES  ("
                . "'" . $orderedAt . "', "
                . "'" . $this->member . "', "
                . "'" . $this->address . "', "
                . "'" . $this->city . "', "
                . "'" . $this->contactNo1 . "', "
                . "'" . $this->contactNo2 . "', "
                . "'" . $this->district . "', "
                . "'" . $this->amount . "', "
                . "'" . $this->orderNote . "', "
                . "'" . 1 . "')";

        $db = new Database();
        $result = $db->readQuery2($query);

        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getOrdersByDeliveryStatusAndMember($member, $status) {

        $query = "SELECT * FROM `orders` WHERE `delivery_status`='" . $status . "' AND `status`='1' AND `member`='" . $member . "'";

        $db = new Database();
        $result = $db->readQuery1($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getCanceledOrdersByMember($member) {

        $query = "SELECT * FROM `orders` WHERE `status`='0' AND `member`='" . $member . "'";

        $db = new Database();
        $result = $db->readQuery1($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDetailsByID($id) {
        $query = "SELECT * FROM `orders` WHERE `id` = $id";
        $db = new Database();
        $result = $db->readQuery1($query);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    function sendOrderMail($products) {
        require_once "Mail.php";

        $CUSTOMER = new Customer($this->member);
        $ORDER = new Order($this->id);
        $DISTRICT = new District($ORDER->district);
        $CITY = new City($ORDER->city);
        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "Cash On Delivery";
        $website_name = "www.cashondelivery.lk";
        $comConNumber = "+94778911491";
        $comEmail = "info@cashondelivery.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "info@cashondelivery.lk";
        $password = 'IT5U4!CoJdK{';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "info@cashondelivery.lk";
        $visitorSubject = "Order Enquiry - #" . $this->id;

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table>
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <b><p>Dear Valued Customer<br />Mr/Mrs/Miss/Dr/Rev. ' . $CUSTOMER->name . ',</p></b>
                                                                        <p>Thank you very much for placing an order with us. Your order will be delivered within 48 hours of order placement and you may make the payment to the delivery person.</p>
                                                                        <p>*Please be kindly informed that prices are subjected to change upon confirmation of the order depending on the dealer/merchant who handles your order. (due to prevailing situation of the country)</p>
                                                                        <p><b>Please follow the below instructions once you receive this email.</b></p>
                                                                        <ul>
                                                                            <li>Your order is not confirmed yet.</li>
                                                                            <li>One of our venders will contact you soon, regarding the order details, and will keep you informed about any changes (missing items, missing brand replacements, any change in pricing).</li>
                                                                            <li>Once you are agreed, the order will be confirmed.</li>
                                                                            <li>Pay in Cash On Deliver (please keep the exact amount in your possession)</li>
                                                                        </ul>
                                                                        <p style="margin-bottom:0; margin-top: 0;"><b>Order ID</b>: #' . $this->id . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>Date & Time</b>: ' . $ORDER->orderedAt . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>District</b>: ' . $DISTRICT->name . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>City</b>: ' . $CITY->name . '</p>
                                                                        <p style="margin-bottom:25px; margin-top: 3px;"><b>Address</b>: ' . $ORDER->address . '</p>
                                                                        <p style="margin-bottom:15px;"><a href="https://www.cashondelivery.lk/member/view-order.php?id=' . $this->id . '" style="padding: 10px; background: #9C27B0; color: #fff; text-decoration: none; text-transform: uppercase; font-weight: 600;">Click here to see more details</a></p> 
                                                                    </td>         
                                                                </tr> 
                                                                <tr>
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left">
                                                                        <p><b>Thanks & Best Regards!...</b></p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">This is an automated message, do not reply to this email.</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Email: info@cashondelivery.lk</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Phone: +94778911491</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Web: www.cashondelivery.lk</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $html1 = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table>
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <b><p>Dear Valued Customer<br />Mr/Mrs/Miss/Dr/Rev. ' . $CUSTOMER->name . ',</p></b>
                                                                        <p>Thank you very much for placing an order with us. Your order will be delivered within 48 hours of order placement and you may make the payment to the delivery person.</p>
                                                                        <p>*Please be kindly informed that prices are subjected to change upon confirmation of the order depending on the dealer/merchant who handles your order. (due to prevailing situation of the country)</p>
                                                                        <p><b>Please follow the below instructions once you receive this email.</b></p>
                                                                        <ul>
                                                                            <li>Your order is not confirmed yet.</li>
                                                                            <li>One of our venders will contact you soon, regarding the order details, and will keep you informed about any changes (missing items, missing brand replacements, any change in pricing).</li>
                                                                            <li>Once you are agreed, the order will be confirmed.</li>
                                                                            <li>Pay in Cash On Deliver (please keep the exact amount in your possession)</li>
                                                                        </ul>
                                                                        <p style="margin-bottom:0; margin-top: 0;"><b>Order ID</b>: #' . $this->id . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>Date & Time</b>: ' . $ORDER->orderedAt . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>District</b>: ' . $DISTRICT->name . '</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px;"><b>City</b>: ' . $CITY->name . '</p>
                                                                        <p style="margin-bottom:25px; margin-top: 3px;"><b>Address</b>: ' . $ORDER->address . '</p>
                                                                        <p style="margin-bottom:15px;"><a href="https://cashondelivery.lk/control-panel/view-order.php?id=' . $this->id . '" style="padding: 10px; background: #9C27B0; color: #fff; text-decoration: none; text-transform: uppercase; font-weight: 600;">Click here to see more details</a></p> 
                                                                    </td>         
                                                                </tr> 
                                                                <tr>
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left">
                                                                        <p><b>Thanks & Best Regards!...</b></p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">This is an automated message, do not reply to this email.</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Email: info@cashondelivery.lk</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Phone: +94778911491</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Web: www.cashondelivery.lk</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $visitorHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $CUSTOMER->email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject);

        $companyHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $webmail,
            'Reply-To' => $CUSTOMER->email,
            'Subject' => $visitorSubject);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $visitorMail = $smtp->send($CUSTOMER->email, $visitorHeaders, $html);
        $companyMail = $smtp->send($webmail, $companyHeaders, $html1);
        $arr = array();
        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }

    function sendOrderMailToAdmin($products) {
        require_once "Mail.php";

        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($CUSTOMER->district);
        $CITY = new City($CUSTOMER->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        $comany_name = "Cash On Delivery";
        $website_name = "www.cashondelivery.lk";
        $comConNumber = "+94778911491";
        $comEmail = "info@cashondelivery.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "info@cashondelivery.lk";
        $password = 'IT5U4!CoJdK{';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "info@cashondelivery.lk";
        $companySubject = "Order Enquiry - #" . $this->id;

        $html1 = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $CUSTOMER->name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p>Thank you for purchasing with us and our one of representative will contact you shortly. Your Order id is ' . $this->id . '. Do not be hesitate to contact us via hotline for any enquiries.</p></td> 
                                                                        <p>Please click this <a href="https://cashondelivery.lk/control-panel/view-order.php?id=' . $this->id . '">link</a> to view your order details.</p>    
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $companyHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $webmail,
            'Reply-To' => $CUSTOMER->email,
            'Subject' => $companySubject);

        $companyMail = $smtp->send($webmail, $companyHeaders, $html);

        $arr = array();
        if (PEAR::isError($companyMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }
        return $arr;
    }

    function sendDirectOrderMail($products) {
        require_once "Mail.php";

        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($CUSTOMER->district);
        $CITY = new City($CUSTOMER->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "FreshCart.lk";
        $website_name = "www.freshcart.lk";
        $comConNumber = "+94778911491";
        $comEmail = "orders@freshcart.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "orders@freshcart.lk";
        $password = 'fux}Xuk$xCP0';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "orders@freshcart.lk";
        $visitorSubject = "Order Enquiry - #" . $this->id;

        $tr = '';
        $tot = 0;
        $id = 0;
        foreach ($products as $key => $product) {
            $PRODUCT = new Product($product['product']);
            $tot += $product['amount'];
            $id++;
            $tr .= '<tr>';
            $tr .= '<td>' . $id . '</td>';
            $tr .= '<td>' . $PRODUCT->name . '</td>';
            $tr .= '<td>' . $product['qty'] . ' ' . $PRODUCT->unite . '</td>';
            $tr .= '<td style="text-align: right;">Rs. ' . number_format($product['amount'], 2) . '</td>';
            $tr .= '</tr>';
        }
        $processing_fee = ($tot + 950) * 3 / 100;
        $grand_total = $tot + 950 + $processing_fee;

        $status = "";
        if ($this->paymentStatusCode == 2 && $this->status == 1) {
            $status = "Successful.";
        } else {
            $status = "Unsuccessful. Please resume your order.";
        }
        if ($this->paymentStatusCode != 2 && $this->status == 1 && $this->deliveryStatus == 5) {
            $status = "Not Paid";
        }

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $CUSTOMER->name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p>Please be kindly informed that online payment gateway system is stuck due to high traffic. If you want to procceed this order, kindly make an online transfer to our bosss personal account.
                                                                            Account details are stated below.<br /><br />
                                                                            <b>Account Number: 1051 5726 3124</b><br />
                                                                            <b>Name: E.K.S. Edirisinghe</b><br />
                                                                            <b>Bank: Sampath Bank</b><br />
                                                                            <b>Branch: Peradeniya</b><br /><br />

                                                                            Then follow the steps mentioned below.<br />
                                                                            01. Make the online transaction.<br />
                                                                            02. Create the screenshot of success report.<br />
                                                                            03. Email into directorders@freshcart.lk & whatsapp into 071 890 5282.</p><br />
                                                                            
                                                                            
                                                                        <p>Please find the attached details of the purchase below. Do not be hesitate to contact us via hotline for any enquiries.</p>
                                                                    </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:15px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:0 0 8px;font-weight: 700;" align="left"> The Details :</td>
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <ul>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Full Name : ' . $CUSTOMER->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Email : ' . $CUSTOMER->email . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:14px">
                                                                                Contact No : ' . $CUSTOMER->phone_number . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Address : ' . $this->address . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                City : ' . $CITY->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                District : ' . $DISTRICT->name . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Ordered At : ' . $this->orderedAt . '
                                                                            </font>
                                                                        </li>
                                                                        <li>
                                                                            <font style="font-family: Verdana, Geneva, sans-serif; color:#68696a; font-size:14px; " >
                                                                                Payment Status : ' . $status . '
                                                                            </font>
                                                                        </li>
                                                                            
                                                                            <table width="100%" border="1" style="margin-top: 10px" cellspacing="0" cellpadding="0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ID</th>
                                                                                        <th>Product</th>
                                                                                        <th>Qty</th>
                                                                                        <th>Amount</th>
                                                                                    </tr>

                                                                                </thead>
                                                                                <tbody>
                                                                                    ' . $tr . '
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($tot, 2) . '</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Delivery Charges</th>
                                                                                        <th style="text-align: right;">Rs. 950.00</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Online Transaction Processing Fee(3%)</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($processing_fee, 2) . '</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3" style="text-align: left;">Grand Total</th>
                                                                                        <th style="text-align: right;">Rs. ' . number_format($grand_total, 2) . '</th>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                    </ul>
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:10px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px 10px" align="left"> <p> Cheers, </p>
                                                                        <p> Team - FreshCart.lk </p>
                                                                    </td> 
                                                                </tr>
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p>* Special Note - Do not delete this e-mail, instead keep it as the invoice to submit the delivery person.</p></td> 
                                                                </tr> 
                                                                    
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#fff" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                                </tr> 
                                                            </tbody> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td style="padding:10px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0"> 
                                                                        </p><p style="line-height:24px;margin:0;padding:0">' . $comany_name . '</p>
                                                                        <p style="line-height:24px;margin:0;padding:0">Email : ' . $comEmail . ' </p> 
                                                                        <p style="line-height:24px;margin:0;padding:0">Tel: ' . $comConNumber . '</p> </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $visitorHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $CUSTOMER->email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject);

        $companyHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $webmail,
            'Reply-To' => $CUSTOMER->email,
            'Subject' => $visitorSubject);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $visitorMail = $smtp->send($CUSTOMER->email, $visitorHeaders, $html);
        $companyMail = $smtp->send($webmail, $companyHeaders, $html);
        $arr = array();
        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }

    function sendPaymentFailureMail() {
        require_once "Mail.php";

        $CUSTOMER = new Customer($this->member);
        $DISTRICT = new District($CUSTOMER->district);
        $CITY = new City($CUSTOMER->city);

        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "FreshCart.lk";
        $website_name = "www.freshcart.lk";
        $comConNumber = "+94778911491";
        $comEmail = "orders@freshcart.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "orders@freshcart.lk";
        $password = 'fux}Xuk$xCP0';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "orders@freshcart.lk";
        $visitorSubject = "Order Enquiry - #" . $this->id . " - Payment Not Successful";

        $status = "";
        if ($this->paymentStatusCode == 2 && $this->status == 1) {
            $status = "Successful.";
        } else {
            $status = "Unsuccessful. Please resume your order.";
        }

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 25px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:15px 20px 10px;font-weight: 600;" align="left"> Hi , ' . $CUSTOMER->name . ' </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <p style="word-wrap:break-word;font-size:14px;color:red;line-height:20px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px">Your payment was not successful... </p>
                                                                        <p>Please be kindly informed that we have not received your payment successfully, but in case if your merchant/bank has already deducted the amount from your bank account, please contact PayHere Private Limited via 011 3009975 or 077 2929333 and get it refunded within 24 hours of payment.</p>
                                                                        <p>If your payment is not successful, click <a href="https://www.freshcart.lk/return.php?order=' . $this->id . '">here</a> for a re-payment. Thank you.</p>
                                                                    </td> 
                                                                </tr> 
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:20px;border:1px solid #dcdee3;width:600px;background-color:#fff"> 
                                                        
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:10px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px 10px" align="left"> <p> Cheers, </p>
                                                                        <p> Team - FreshCart.lk </p>
                                                                    </td> 
                                                                </tr>
                                                                    
                                                            </tbody> 
                                                        </table> 
                                                        <table style="background-color:#fff" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#fff"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                                </tr> 
                                                            </tbody> 
                                                            <tbody>
                                                                <tr> 
                                                                    <td style="padding:10px 0 7px;color:#9a9a9a;text-align:left;font-family:Arial,Helvetica,sans-serif;font-size:12px" align="left"> <p style="line-height:18px;margin:0;padding:0"> 
                                                                        </p><p style="line-height:24px;margin:0;padding:0">' . $comany_name . '</p>
                                                                        <p style="line-height:24px;margin:0;padding:0">Email : ' . $comEmail . ' </p> 
                                                                        <p style="line-height:24px;margin:0;padding:0">Tel: ' . $comConNumber . '</p> </td> 
                                                                </tr> 
                                                            </tbody>
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        $visitorHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $CUSTOMER->email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject);

        $companyHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $webmail,
            'Reply-To' => $CUSTOMER->email,
            'Subject' => $visitorSubject);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $visitorMail = $smtp->send($CUSTOMER->email, $visitorHeaders, $html);
        $companyMail = $smtp->send($webmail, $companyHeaders, $html);
        $arr = array();
        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }

    public function getPendingOrdersByDealerAreas($dealer) {

        $query = "SELECT * FROM `orders` WHERE `status`='1' AND `delivery_status` = '0' AND `dealer` = '0' AND `city` IN (SELECT distinct(`city`) FROM `dealer_area` WHERE `dealer` = '" . $dealer . "')";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDealerConfirmedOrders($dealer) {

        $query = "SELECT * FROM `orders` WHERE `status`='1' AND `delivery_status` = '1' AND `dealer` = '" . $dealer . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDealerCompletedOrders($dealer) {

        $query = "SELECT * FROM `orders` WHERE `status`='1' AND `delivery_status` = '2' AND `dealer` = '" . $dealer . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDealerCanceledOrders($dealer) {

        $query = "SELECT * FROM `orders` WHERE `status`='1' AND `delivery_status` = '3' AND `dealer` = '" . $dealer . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    function sendOrderMailToDealer($dealer) {
        require_once "Mail.php";

        $DEALER = new Dealer($dealer);
        $ORDER = new Order($this->id);
        $DISTRICT = new District($ORDER->district);
        $CITY = new City($ORDER->city);
        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "Cash On Delivery";
        $website_name = "www.cashondelivery.lk";
        $comConNumber = "+94778911491";
        $comEmail = "info@cashondelivery.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "info@cashondelivery.lk";
        $password = 'IT5U4!CoJdK{';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "info@cashondelivery.lk";
        $dealerSubject = "New Pending Order";

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table>
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <b><p>Dear Valued Dealer<br />Mr/Mrs/Miss/Dr/Rev. ' . $DEALER->name . ',</p></b>
                                                                        <p>You have a new pending order. Please check it and confirmed it as soon as posssible.</p>
                                                                        <p style="margin-bottom:15px;"><a href="https://www.cashondelivery.lk/dealer/pending-orders.php" style="padding: 10px; background: #9C27B0; color: #fff; text-decoration: none; text-transform: uppercase; font-weight: 600;">Click here to see more details</a></p> 
                                                                    </td>         
                                                                </tr> 
                                                                <tr>
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left">
                                                                        <p><b>Thanks & Best Regards!...</b></p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">This is an automated message, do not reply to this email.</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Email: info@cashondelivery.lk</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Phone: +94778911491</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Web: www.cashondelivery.lk</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        

        $dealerHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $DEALER->email,
            'Reply-To' => $comEmail,
            'Subject' => $dealerSubject);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $dealerMail = $smtp->send($DEALER->email, $dealerHeaders, $html);
        $arr = array();
        if (PEAR::isError($dealerMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }
    
    function sendOrderConfirmationMailToCustomer() {
        require_once "Mail.php";

        
        $ORDER = new Order($this->id);
        $DEALER = new Dealer($ORDER->dealer);
        $CUSTOMER = new Customer($ORDER->member);
        $DISTRICT = new District($ORDER->district);
        $CITY = new City($ORDER->city);
        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "Cash On Delivery";
        $website_name = "www.cashondelivery.lk";
        $comConNumber = "+94778911491";
        $comEmail = "info@cashondelivery.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "info@cashondelivery.lk";
        $password = 'IT5U4!CoJdK{';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "info@cashondelivery.lk";
        $dealerSubject = "Order Confirmation - #" . $this->id;

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Cash On Delivery Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table>
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <b><p>Dear Valued Customer<br />Mr/Mrs/Miss/Dr/Rev. ' . $CUSTOMER->name . ',</p></b>
                                                                        <p>You order has been confirmed successfully.</p>
                                                                        <p><b>Please see the below details of your vender dealer.</b></p>
                                                                        <ul>
                                                                            <li><b>Dealer</b>: ' . $DEALER->name . '</li>
                                                                            <li><b>Phone Number</b>: ' . $DEALER->phone . '</li>
                                                                            <li><b>Email</b>: ' . $DEALER->email . '</li>
                                                                            <li><b>NIC</b>: ' . $DEALER->nic . '</li>
                                                                            <li><b>Business Name</b>: ' . $DEALER->business_name . '</li>
                                                                            <li><b>BR No.</b>: ' . $DEALER->br_number . '</li>
                                                                        </ul>
                                                                        
                                                                    </td>         
                                                                </tr> 
                                                                <tr>
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left">
                                                                        <p><b>Thanks & Best Regards!...</b></p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">This is an automated message, do not reply to this email.</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Email: info@cashondelivery.lk</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Phone: +94778911491</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Web: www.cashondelivery.lk</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr> 
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';

        

        $customerHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $CUSTOMER->email,
            'Reply-To' => $comEmail,
            'Subject' => $dealerSubject);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $customerMail = $smtp->send($CUSTOMER->email, $customerHeaders, $html);
        $arr = array();
        if (PEAR::isError($customerMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }
        return $arr;
    }

}
