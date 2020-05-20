<?php

/**
 * Description of OrderProduct
 *
 * @author U s E r ¨
 */
class OrderProduct {

    public $id;
    public $order;
    public $product;
    public $qty;
    public $amount;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT *  FROM `order_product` WHERE `id`='" . $id . "'";

            $db = new Database();

            $result = mysql_fetch_assoc($db->readQuery($query));

            $this->id = $result['id'];
            $this->order = $result['order'];
            $this->product = $result['product'];
            $this->qty = $result['qty'];
            $this->amount = $result['amount'];

            return $result;
        }
    }

    public function create() {

        $query = "INSERT INTO `order_product` ("
                . "`order`,"
                . "`product`,"
                . "`qty`,"
                . "`amount`) VALUES  ("
                . "'" . $this->order . "', "
                . "'" . $this->product . "', "
                . "'" . $this->qty . "', "
                . "'" . $this->amount . "')";

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

        $query = "SELECT * FROM `order_product`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `order_product` SET "
                . "`order` ='" . $this->order . "', "
                . "`product` ='" . $this->product . "', "
                . "`qty` ='" . $this->qty . "', "
                . "`amount` ='" . $this->amount . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function getProductsByOrder($order) {

        $query = "SELECT * FROM `order_product` WHERE `order`='" . $order . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function delete() {

        $query = 'DELETE FROM `order_product` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function createOrderProduct() {

        $query = "INSERT INTO `order_product` ("
                . "`order`,"
                . "`product`,"
                . "`qty`,"
                . "`amount`) VALUES  ("
                . "'" . $this->order . "', "
                . "'" . $this->product . "', "
                . "'" . $this->qty . "', "
                . "'" . $this->amount . "')";

        $db = new Database();
        $result = $db->readQuery1($query);

        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getOrdersById($order) {

        $query = "SELECT * FROM `order_product` WHERE `order` = $order";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getOrderProductsById($order) {

        $query = "SELECT * FROM `order_product` WHERE `order` = $order";

        $db = new Database();
        $result = $db->readQuery1($query);
        $array_res = array();

        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getPendingOrdersProducts() {

        $query = "SELECT `product`, sum(`qty`) AS `qty` FROM `order_product` WHERE `order` IN (SELECT `id` FROM `orders` WHERE `payment_status_code` = 2 AND `delivery_status` = 0 AND `status` = 1) GROUP BY `product`";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getConfirmedOrdersProducts() {

        $query = "SELECT `product`, sum(`qty`) AS `qty` FROM `order_product` WHERE `order` IN (SELECT `id` FROM `orders` WHERE `payment_status_code` = 2 AND `delivery_status` = 1 AND `status` = 1) GROUP BY `product`";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

}
