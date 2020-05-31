<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameSessionMembers
 *
 * @author W j K n``
 */
class GameSessionMembers {

    public $id;
    public $game_session;
    public $member;
    public $is_online;
    public $sort;

    public function __construct($id) {

        if ($id) {
            $query = "SELECT `id`,`game_session`,`member`,`is_online`,`sort` FROM `game_session_members` WHERE `id`=" . $id;
            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));
            $this->id = $result['id'];
            $this->game_session = $result['game_session'];
            $this->member = $result['member'];
            $this->is_online = $result['is_online'];
            $this->sort = $result['sort'];
            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `game_session_members` (`game_session`,`member`,`is_online`,`sort`) VALUES  ('"
                . $this->game_session . "','"
                . $this->member . "', '"
                . $this->is_online . "', '"
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

    public function getMembersByGameSession($id) {
        $query = "SELECT * FROM `game_session_members` WHERE `game_session` = $id ORDER BY sort ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysql_fetch_array($result)) {

            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getNextPlayer($session, $sort) {
        $query = "SELECT * FROM `game_session_members` WHERE `sort` = $sort AND `game_session` = $session";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));
        return $result;
    }

    public function update() {
        $query = "UPDATE  `game_session_members` SET "
                . "`game_session` ='" . $this->game_session . "', "
                . "`member` ='" . $this->member . "', "
                . "`is_online` ='" . $this->is_online . "', "
                . "`sort` ='" . $this->sort . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }

    public function updateOnlineStatus($mem, $session) {
        $query = "UPDATE  `game_session_members` SET "
                . "`is_online` =0 "
                . "WHERE `member` = $mem AND `game_session` = $session";

        $db = new Database();
        $result = $db->readQuery($query);
        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function delete() {
        $query = 'DELETE FROM `game_session_members` WHERE id="' . $this->id . '"';

        $db = new Database();
        return $db->readQuery($query);
    }

}
