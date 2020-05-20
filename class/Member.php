<?php

/**
 * Description of Member
 *
 * @author W j K n``
 * @web www.synotec.lk
 */
class Member {

    //put your code here
    public $id;
    public $createdAt;
    public $name;
    public $email;
    public $password;
    public $phone_number;
    public $country;
    public $address;
    public $resetcode;
    public $authToken;
    public $image_name;
    public $verifyCode;
    public $isVerified;
    public $isActive;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `member` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->createdAt = $result['created_at'];
            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->password = $result['password'];
            $this->phone_number = $result['phone_number'];
            $this->country = $result['country'];
            $this->address = $result['address'];
            $this->resetcode = $result['resetcode'];
            $this->authToken = $result['authToken'];
            $this->image_name = $result['image_name'];
            $this->verifyCode = $result['verify_code'];
            $this->isVerified = $result['is_verified'];
            $this->isActive = $result['is_active'];

            return $this;
        }
    }

    public function create() {
        date_default_timezone_set('Asia/Colombo');
        $createdAt = date('Y-m-d H:i:s');

        $query = "INSERT INTO `member` (`created_at`, `name`, `email`, `password`,`phone_number`,`country`,`address`,`image_name`,`verify_code`,`is_verified`,`is_active`) VALUES  ('"
                . $createdAt . "','"
                . $this->name . "','"
                . $this->email . "', '"
                . $this->password . "', '"
                . $this->phone_number . "', '"
                . $this->country . "', '"
                . $this->address . "', '"
                . $this->image_name . "', '"
                . $this->verifyCode . "', '"
                . $this->isVerified . "', '"
                . 1 . "')";

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

        $query = "SELECT * FROM `member`";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {


        $query = "SELECT  * FROM `member` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setUserSession($this->id);
            $member = $this->__construct($this->id);
            return $member;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
        unset($_SESSION["phone_number"]);
        unset($_SESSION["authToken"]);
        unset($_SESSION["image_name"]);

        return TRUE;
    }

    private function setUserSession($member) {

        if (!isset($_SESSION)) {
            session_start();
        }
        $member = $this->__construct($member);

        $_SESSION["id"] = $member->id;
        $_SESSION["name"] = $member->name;
        $_SESSION["email"] = $member->email;
        $_SESSION["phone_number"] = $member->phone_number;
        $_SESSION["authToken"] = $member->authToken;
        $_SESSION["image_name"] = $member->image_name;
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `member` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

        $db = new Database();

        if ($db->readQuery($query)) {
            return $authToken;
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

        $query = "SELECT `id` FROM `member` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkEmail($email) {

        $query = "SELECT `id`,`email`,`name` FROM `member` WHERE `email`= '" . $email . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function checkPhoneNumber($phone) {

        $query = "SELECT `id`,`email`,`name` FROM `member` WHERE `phone_number`= '" . $phone . "'";

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

        $query = "UPDATE  `member` SET "
                . "`resetcode` ='" . $rand . "' "
                . "WHERE `email` = '" . $email . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function SelectForgetCustomer($email) {

        if ($email) {

            $query = "SELECT `email`,`name`,`resetcode` FROM `member` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function SelectResetCode($code) {

        $query = "SELECT `id` FROM `member` WHERE `resetcode`= '" . $code . "'";

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

        $query = "UPDATE  `member` SET "
                . "`password` ='" . $enPass . "' "
                . "WHERE `resetcode` = '" . $code . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updateVerifyCode($id, $code) {

        $query = "UPDATE  `member` SET "
                . "`verify_code` ='" . $code . "', "
                . "`is_verified` ='0' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }
    public function updateMemberStatus() {

        $query = "UPDATE  `member` SET "
                . "`is_active` = '" . $this->isActive . "'"
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function updatePhoneNumber($id, $phoneNumber) {

        $query = "UPDATE  `member` SET "
                . "`phone_number` ='" . $phoneNumber . "' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION["phone_number"] = $phoneNumber;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function verifyAccount($id) {

        $query = "UPDATE  `member` SET "
                . "`is_verified` ='1' "
                . "WHERE `id` = '" . $id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update() {

        $query = "UPDATE  `member` SET "
                . "`name` ='" . $this->name . "', "
                . "`email` ='" . $this->email . "', "
                . "`password` ='" . $this->password . "', "
                . "`phone_number` ='" . $this->phone_number . "', "
                . "`country` ='" . $this->country . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`address` ='" . $this->address . "' "
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

        $query = 'DELETE FROM `member` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetMembersByCountry($country) {

        $query = "SELECT * FROM `member` WHERE `country` = '" . $country . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function deleteMembersByCountry($country) {

        $query = "DELETE FROM `member` WHERE `country`= '" . $country . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `member` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
