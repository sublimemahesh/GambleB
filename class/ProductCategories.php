<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Nipuni
 */
class ProductCategories {

    public $id;
    public $name;
    public $icon;
    public $banner;
    public $sort;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `product_categories` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->icon = $result['icon'];
            $this->banner = $result['banner'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `product_categories` (`name`,`icon`,`banner`,`sort`) VALUES  ('"
                . $this->name . "', '"
                . $this->icon . "', '"
                . $this->banner . "', '"
                . $this->sort . "')";


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

        $query = "SELECT * FROM `product_categories` ORDER BY sort ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `product_categories` SET "
                . "`name` ='" . $this->name . "', "
                . "`icon` ='" . $this->icon . "', "
                . "`banner` ='" . $this->banner . "' "
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

        unlink(Helper::getSitePath() . "upload/product-categories/icon/" . $this->icon);
        unlink(Helper::getSitePath() . "upload/product-categories/banner/" . $this->banner);
        $query = 'DELETE FROM `product_categories` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getProductsById($product_categories) {

        $query = 'SELECT * FROM `product_categories` WHERE type="' . $product_categories . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function arrange($key, $img) {

        $query = "UPDATE `product_categories` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
