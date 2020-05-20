<?php

/**
 * Description of DealerArea
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
class DealerArea {

    //put your code here
    public $id;
    public $city;
    public $dealer;
    public $status;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`city`,`dealer`,`status` FROM `dealer_area` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->city = $result['city'];
            $this->dealer = $result['dealer'];
            $this->status = $result['status'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `dealer_area` "
                . "(`city`,"
                . " `dealer`, "
                . "`status`) "
                . "VALUES  "
                . "('" . $this->city . "',"
                . "'" . $this->dealer . "',"
                . " '1')";

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

        $query = "SELECT * FROM `dealer_area`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = 'UPDATE `dealer_area` SET `status`= "' . $this->status . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $query = 'DELETE FROM `dealer_area` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getAreasByDealer($dealer) {

        $query = "SELECT * FROM `dealer_area` WHERE `dealer` = '" . $dealer . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getDealersByArea() {

        $query = "SELECT * FROM `dealer_area` WHERE `city` = '" . $this->city . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkExists() {

        $query = "SELECT * FROM `dealer_area` WHERE `dealer` = '" . $this->dealer . "' AND `city` = '" . $this->city . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        return $result;
    }

}
