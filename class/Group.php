<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * end_date_time of Group
 *
 * @author W j K n``
 */
class Group {
    public $id;
    public $game;
    public $member;
    public $created_at;
    public $end_date_time;
    public $status;

    public function __construct($id) {

        if ($id) {
            $query = "SELECT `id`,`game`,`member`,`created_at`,`end_date_time`,`status` FROM `group` WHERE `id`=" . $id;
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));
            $this->id = $result['id'];
            $this->game = $result['game'];
            $this->member = $result['member'];
            $this->created_at = $result['created_at'];
            $this->end_date_time = $result['end_date_time'];
            $this->status = $result['status'];
            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO `group` (`game`,`member`,`created_at`,`end_date_time`,`status`) VALUES  ('"
                . $this->game . "','"
                . $this->member . "', '"
                . $createdAt . "', '"
                . $this->end_date_time . "', '"
                . $this->status . "')";
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
        $query = "SELECT * FROM `group` ORDER BY status ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    public function getGroupsByMember($id) {
        $query = "SELECT * FROM `group` WHERE `member` = $id ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {
        $query = "UPDATE  `group` SET "
                . "`game` ='" . $this->game . "', "
                . "`member` ='" . $this->member . "', "
                . "`end_date_time` ='" . $this->end_date_time . "', "
                . "`status` ='" . $this->status . "' "
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
        $query = 'DELETE FROM `group` WHERE id="' . $this->id . '"';
        
        $db = new Database();
        return $db->readQuery($query);
    }

}
