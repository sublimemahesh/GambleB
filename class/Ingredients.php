<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

/**

 * Description of Room_photo

 *

 * @author Suharshana DsW

 */
class Ingredients {

    public $id;
    public $product;
    public $image_name;
    public $caption;
    public $queue;

    public function __construct($id) {

        if ($id) {



            $query = "SELECT `id`,`product`,`image_name`,`caption`,`queue` FROM `ingredients` WHERE `id`=" . $id;



            $db = new Database();



            $result = mysql_fetch_array($db->readQuery($query));



            $this->id = $result['id'];

            $this->product = $result['product'];

            $this->image_name = $result['image_name'];

            $this->caption = $result['caption'];

            $this->queue = $result['queue'];



            return $this;
        }
    }

    public function create() {



        $query = "INSERT INTO `ingredients` (`product`,`image_name`,`caption`,`queue`) VALUES  ('"
                . $this->product . "','"
                . $this->image_name . "', '"
                . $this->caption . "', '"
                . $this->queue . "')";

      

        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            $last_id = mysql_insert_id();



            return $this->__construct($last_id);
        } else {

            return FALSE;
        }
    }

    public function all() {



        $query = "SELECT * FROM `ingredients` ORDER BY queue ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();



        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }



        return $array_res;
    }

    public function update() {



        $query = "UPDATE  `ingredients` SET "
                . "`product` ='" . $this->product . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`caption` ='" . $this->caption . "', "
                . "`queue` ='" . $this->queue . "' "
                . "WHERE `id` = '" . $this->id . "'";



        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `ingredients` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

    public function getIngredientsByProductId($product) {



        $query = "SELECT * FROM `ingredients` WHERE `product`= $product ORDER BY queue ASC";



        $db = new Database();



        $result = $db->readQuery($query);

        $array_res = array();



        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function arrange($key, $img) {

        $query = "UPDATE `ingredients` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        return $result;
    }

}
