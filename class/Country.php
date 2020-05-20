<?php

/**
 * Description of Country
 *
 * @author W j K n``
 * @web www.synotec.lk
 */
class Country {

    public $id;
    public $name;
    public $sort = 100;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`sort` FROM `country` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->sort = $result['sort'];

            return $this;
        }
    }

    public function getCountryByName($name) {

        $query = "SELECT `id` FROM `country` WHERE `name` LIKE '" . $name . "'";
        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function create() {

        $query = "INSERT INTO `country` (`name`, `sort`) VALUES  ('" . $this->name . "', '" . $this->sort . "')";

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

        $query = "SELECT * FROM `country` ORDER BY `name` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `country` SET `name`= "' . $this->name . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function arrange($key, $img) {
        $query = "UPDATE `country` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function delete() {
        $query = 'DELETE FROM `country` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
