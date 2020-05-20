<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GroupMember
 *
 * @author W j K n``
 */
class GroupMember {

    public $id;
    public $group;
    public $member;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`group`,`member` FROM `group_member` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->group = $result['group'];
            $this->member = $result['member'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `group_member` (`group`, `member`) VALUES  ('" . $this->group . "', '" . $this->member . "')";

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

        $query = "SELECT * FROM `group_member` ORDER BY `id` ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkMemberJoinedOrNot($group, $member) {

        $query = "SELECT `id` FROM `group_member` WHERE `group` = $group AND `member` = $member";
        $db = new Database();
        $result = mysql_fetch_assoc($db->readQuery($query));
        
        if ($result) {
            return TRUE;
        
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = 'UPDATE `group_member` SET `group`= "' . $this->group . '" WHERE id="' . $this->id . '"';

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {
        $query = 'DELETE FROM `group_member` WHERE id="' . $this->id . '"';
        $db = new Database();
        return $db->readQuery($query);
    }

}
