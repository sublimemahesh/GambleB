
application/x-httpd-php Visitor.php ( PHP script text )

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Visitor
 *
 * @author User
 */
class Visitor {

    public $id;
    public $name;
    public $email;
    public $address;
    public $contact_number;
    public $profile_picture;
    public $createdAt;
    public $isActive;
    public $facebookID;
    public $authToken;
    public $lastLogin;
    public $resetCode;
    public $password;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`name`,`email`,`address`,`contact_number`,`profile_picture`,`createdAt`,`isActive`,`facebookID`,`authToken`,`lastLogin`,`resetCode` FROM `visitor` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->address = $result['address'];
            $this->contact_number = $result['contact_number'];
            $this->profile_picture = $result['profile_picture'];
            $this->createdAt = $result['createdAt'];
            $this->isActive = $result['isActive'];
            $this->facebookID = $result['facebookID'];
            $this->lastLogin = $result['lastLogin'];
            $this->authToken = $result['authToken'];
            $this->resetCode = $result['resetCode'];

            return $result;
        }
    }

    public function create() {

        date_default_timezone_set('Asia/Colombo');

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `visitor` (`createdAt`,`name`,`email`,`password`) VALUES  ('"
                . $createdAt . "', '"
                . $this->name . "', '"
                . $this->email . "', '"
                . $this->password . "')";

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

        $query = "SELECT * FROM `visitor` ORDER BY id ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    
    public function delete() {
        
        unlink(Helper::getSitePath() . "upload/visitor/" . $this->profile_picture);

        $query = 'DELETE FROM `visitor` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function login($email, $password) {

        
        $query = "SELECT `id`,`name`,`email`,`address`,`contact_number`,`profile_picture`,`createdAt`,`isActive`,`lastLogin` FROM `visitor` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));


        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
//            $this->setLastLogin($this->id);

            $visitor = $this->__construct($this->id);
            
            $this->setUserSession($visitor);

            return $visitor;
        }
    }

    public function checkOldPass($id, $password) {

        $enPass = md5($password);

        $query = "SELECT `id` FROM `visitor` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function changePassword($id, $password) {

        $enPass = md5($password);

        $query = "UPDATE  `visitor` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function authenticate() {

        if (!isset($_SESSION)) {
            session_start();
        }

        $id = NULL;
        $authToken = NULL;

        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
        }

        if (isset($_SESSION["authToken"])) {
            $authToken = $_SESSION["authToken"];
        }

        $query = "SELECT `id` FROM `visitor` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
        
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["isActive"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["lastLogin"]);
        unset($_SESSION["position"]);
     
        return TRUE;
    }

    public function update() {

        $query = "UPDATE  `visitor` SET "
                . "`name` ='" . $this->name . "', "
                . "`email` ='" . $this->email . "', "
                . "`address` ='" . $this->address . "', "
                . "`contact_number` ='" . $this->contact_number . "', "
                . "`profile_picture` ='" . $this->profile_picture . "' "
                . "WHERE `id` = '" . $this->id . "'";
        
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    private function setUserSession($visitor) {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION["id"] = $visitor["id"];
        $_SESSION["name"] = $visitor['name'];
        $_SESSION["email"] = $visitor['email'];
        $_SESSION["address"] = $visitor['address'];
        $_SESSION["contact_number"] = $visitor['contact_number'];
        $_SESSION["profile_picture"] = $visitor['profile_picture'];
        $_SESSION["isActive"] = $visitor['isActive'];
        $_SESSION["authToken"] = $visitor['authToken'];
        $_SESSION["position"] = 'visitor';
        
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `visitor` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {

            return $authToken;
        } else {
            return FALSE;
        }
    }

    private function setLastLogin($id) {

        date_default_timezone_set('Asia/Colombo');

        $now = date('Y-m-d H:i:s');

        $query = "UPDATE `visitor` SET `lastLogin` ='" . $now . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `email` FROM `visitor` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }
    
    public function checkUserName($username) {

        $query = "SELECT `email`,`username` FROM `visitor` WHERE `username`= '" . $username . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            return $result;
        }
    }

    public function GenarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `visitor` SET "
                . "`resetCode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $rand;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetVisitor($email) {

        if ($email) {

            $query = "SELECT `email`,`resetCode` FROM `visitor` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->username = $result['username'];
            $this->email = $result['email'];
            $this->restCode = $result['resetCode'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `visitor` WHERE `resetCode`= '" . $code . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function updatePassword($password, $code) {

        $enPass = md5($password);

        $query = "UPDATE  `visitor` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetCode` = '" . $code . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function isFbIdIsEx($visitorID) {

        $query = "SELECT * FROM `visitor` WHERE `facebookID` = '" . $visitorID . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if ($result === false) {
            return false;
        } else {
            return true;
        }
    }

    public function createByFB($name, $email, $picture, $visitorID, $password) {
        date_default_timezone_set('Asia/Colombo');

        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `visitor` (`createdAt`,`name`,`email`,`profile_picture`,`facebookID`,`password`) VALUES  ('" . $createdAt . "','" . $name . "', '" . $email . "', '" . $picture . "', '" . $visitorID . "', '" . $password . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        $last_id = mysql_insert_id();

        if ($result) {

            $this->loginByFB($visitorID, $password);

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function loginByFB($visitorID, $password) {
        

        $query = "SELECT * FROM `visitor` WHERE `facebookID`= '" . $visitorID . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {
            $this->id = $result['id'];
            $visitor = $this->__construct($this->id);

            if (!isset($_SESSION)) {
                session_start();
                session_unset($_SESSION);
            }
            
            $authtocken = $this->setAuthToken($visitor['id']);
            $_SESSION["login"] = TRUE;
            $_SESSION["id"] = $visitor['id'];
            $_SESSION["authToken"] = $authtocken;
            $_SESSION["position"] = 'visitor';

            return TRUE;
        }
    }

}

