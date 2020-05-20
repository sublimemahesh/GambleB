<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of slider
 *
 * @author Nipuni
 */
class Slider {

    public $id;
    public $title;
    public $image_name;
    public $description;
    public $url;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`title`,`image_name`,`description`,`url`,`queue` FROM `slider` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->image_name = $result['image_name'];
            $this->description = $result['description'];
            $this->url = $result['url'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `slider` (`title`,`image_name`,`description`,`url`,`queue`) VALUES  ('"
                . $this->title . "','"
                . $this->image_name . "', '"
                . $this->description . "', '"
                . $this->url . "', '"
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

        $query = "SELECT * FROM `slider` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `slider` SET "
                . "`title` ='" . $this->title . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`description` ='" . $this->description . "', "
                . "`url` ='" . $this->url . "', "
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

        $query = 'DELETE FROM `slider` WHERE id="' . $this->id . '"';
        unlink(Helper::getSitePath() . "upload/slider/" . $this->image_name);

        $db = new Database();

        return $db->readQuery($query);
    }

    public function arrange($key, $img) {
        $query = "UPDATE `slider` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
