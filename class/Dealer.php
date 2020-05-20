<?php

/**
 * Description of Dealer
 *
 * @author synotec holdings
 * @web www.synotec.lk
 */
class Dealer {

    public $id;
    public $name;
    public $phone;
    public $email;
    public $nic;
    public $address;
    public $district;
    public $city;
    public $business_name;
    public $br_number;
    public $br_copy;
    public $picture;
    public $nic_fr_photo;
    public $nic_bk_photo;
    public $agreement;
    public $password;
    private $authToken;
    public $resetcode;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT  * FROM `dealer` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->name = $result['name'];
            $this->phone = $result['phone'];
            $this->email = $result['email'];
            $this->nic = $result['nic'];
            $this->address = $result['address'];
            $this->city = $result['city'];
            $this->business_name = $result['business_name'];
            $this->br_number = $result['br_number'];
            $this->br_copy = $result['br_copy'];
            $this->district = $result['district'];
            $this->picture = $result['picture'];
            $this->nic_fr_photo = $result['nic_fr_photo'];
            $this->nic_bk_photo = $result['nic_bk_photo'];
            $this->agreement = $result['agreement'];
            $this->password = $result['password'];
            $this->authToken = $result['authToken'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `dealer` ("
                . "`name`, "
                . "`phone`, "
                . "`email`,"
                . "`password`,"
                . "`nic`,"
                . "`address`,"
                . "`district`,"
                . "`city`,"
                . "`business_name`,"
                . "`br_number`,"
                . "`br_copy`,"
                . "`picture`,"
                . "`nic_fr_photo`,"
                . "`nic_bk_photo`"
                . ") VALUES  ('"
                . $this->name . "','"
                . $this->phone . "', '"
                . $this->email . "', '"
                . $this->password . "', '"
                . $this->nic . "', '"
                . $this->address . "', '"
                . $this->district . "', '"
                . $this->city . "', '"
                . $this->business_name . "', '"
                . $this->br_number . "', '"
                . $this->br_copy . "', '"
                . $this->picture . "', '"
                . $this->nic_fr_photo . "', '"
                . $this->nic_bk_photo . "')";

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

        $query = "SELECT * FROM `dealer` ";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function login($email, $password) {


        $query = "SELECT  * FROM `dealer` WHERE `email`= '" . $email . "' AND `password`= '" . $password . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {
            return FALSE;
        } else {

            $this->id = $result['id'];
            $this->setAuthToken($result['id']);
            $this->setUserSession($this->id);
            $dealer = $this->__construct($this->id);
            return $dealer;
        }
    }

    public function logOut() {

        if (!isset($_SESSION)) {
            session_start();
        }

        unset($_SESSION["d_id"]);
        unset($_SESSION["d_login"]);
        unset($_SESSION["d_name"]);
        unset($_SESSION["d_email"]);

        return TRUE;
    }

    private function setUserSession($dealer) {

        if (!isset($_SESSION)) {
            session_start();
        }
        $dealer = $this->__construct($dealer);

        $_SESSION["d_login"] = true;
        $_SESSION["d_id"] = $dealer->id;
        $_SESSION["d_name"] = $dealer->name;
        $_SESSION["d_email"] = $dealer->email;
        $_SESSION["d_phone"] = $dealer->phone;
        $_SESSION["d_authToken"] = $dealer->authToken;
        $_SESSION["d_picture"] = $dealer->picture;
    }

    private function setAuthToken($id) {

        $authToken = md5(uniqid(rand(), true));

        $query = "UPDATE `dealer` SET `authToken` ='" . $authToken . "' WHERE `id`='" . $id . "'";

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

        if (isset($_SESSION["d_id"])) {
            $id = $_SESSION["d_id"];
        }

        if (isset($_SESSION["d_authToken"])) {
            $authToken = $_SESSION["d_authToken"];
        }

        $query = "SELECT `id` FROM `dealer` WHERE `id`= '" . $id . "' AND `authToken`= '" . $authToken . "'";

        $db = new Database();
        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkEmail($id, $email) {

        $query = "SELECT `email`,`name` FROM `dealer` WHERE `email`= '" . $email . "' AND `id` != '" . $id . "'";

        $db = new Database();

        $result = mysql_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            return $result;
        }
    }

    public function genarateCode($email) {

        $rand = rand(10000, 99999);

        $query = "UPDATE  `dealer` SET "
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

    public function selectForgetDealer($email) {

        if ($email) {

            $query = "SELECT `email`,`name`,`resetcode` FROM `dealer` WHERE `email`= '" . $email . "'";

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->name = $result['name'];
            $this->email = $result['email'];
            $this->restCode = $result['resetcode'];

            return $result;
        }
    }

    public function selectResetCode($code) {

        $query = "SELECT `id` FROM `dealer` WHERE `resetcode`= '" . $code . "'";

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

        $query = "UPDATE  `dealer` SET "
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

    public function update() {

        $query = "UPDATE  `dealer` SET "
                . "`name` ='" . $this->name . "', "
                . "`phone` ='" . $this->phone . "', "
                . "`email` ='" . $this->email . "', "
                . "`nic` ='" . $this->nic . "', "
                . "`district` ='" . $this->district . "', "
                . "`city` ='" . $this->city . "', "
                . "`address` ='" . $this->address . "', "
                . "`business_name` ='" . $this->business_name . "', "
                . "`br_number` ='" . $this->br_number . "', "
                . "`br_copy` ='" . $this->br_copy . "', "
                . "`picture` ='" . $this->picture . "', "
                . "`nic_fr_photo` ='" . $this->nic_fr_photo . "', "
                . "`nic_bk_photo` ='" . $this->nic_bk_photo . "', "
                . "`agreement` ='" . $this->agreement . "' "
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

        $query = 'DELETE FROM `dealer` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function GetDealerByDistrict($district) {

        $query = "SELECT * FROM `dealer` WHERE `district` = '" . $district . "'";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getDealersByOrderCity($city) {

        $query = "SELECT * FROM `dealer` WHERE `id` IN (SELECT `dealer` FROM `dealer_area` WHERE `city` = '" . $city . "')";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function checkEmptyData() {

        $query = "SELECT * FROM `dealer` WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        $count = 0;
        foreach (mysql_fetch_assoc($result) as $key => $data) {

            if (empty($data) && $key != 'resetcode' && $key != 'picture' && $key != 'agreement') {
                $count++;
            }
        }
        return $count;
    }

    public function checkAgreement() {

        $query = "SELECT * FROM `dealer` WHERE `id` = '" . $this->id . "'";

        $db = new Database();
        $result = $db->readQuery($query);

        return mysql_fetch_assoc($result)['agreement'];
    }

    public function arrange($key, $img) {
        $query = "UPDATE `dealer` SET `sort` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
