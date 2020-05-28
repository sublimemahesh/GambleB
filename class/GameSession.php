<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameSession
 *
 * @author W j K n``
 */
class GameSession {
    public $id;
    public $created_at;
    public $group;
    public $member;
    public $is_closed;
    public $closed_at;

    public function __construct($id) {

        if ($id) {
            $query = "SELECT `id`,`created_at`,`group`,`member`,`is_closed`,`closed_at` FROM `game_session` WHERE `id`=" . $id;
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));
            $this->id = $result['id'];
            $this->created_at = $result['created_at'];
            $this->group = $result['group'];
            $this->member = $result['member'];
            $this->is_closed = $result['is_closed'];
            $this->closed_at = $result['closed_at'];
            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');
        
        $query = "INSERT INTO `game_session` (`created_at`,`group`,`member`,`is_closed`) VALUES  ('"
                . $createdAt . "','"
                . $this->group . "','"
                . $this->member . "', '"
                . 0 . "')";
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
        $query = "SELECT * FROM `game_session` ORDER BY closed_at ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }
    
    public function aaa() {
        $query = "SELECT * FROM `game_session` WHERE `closed_at` LIKE 'active' ORDER BY `id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function update() {
        $query = "UPDATE  `game_session` SET "
                . "`group` ='" . $this->group . "', "
                . "`member` ='" . $this->member . "', "
                . "`is_closed` ='" . $this->is_closed . "', "
                . "`closed_at` ='" . $this->closed_at . "' "
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
        $query = 'DELETE FROM `game_session` WHERE id="' . $this->id . '"';
        
        $db = new Database();
        return $db->readQuery($query);
    }
}
