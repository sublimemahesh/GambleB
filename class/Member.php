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
    
    public function checkOldPass($id, $password) {
        
        $enPass = md5($password);
        
        $query = "SELECT `id` FROM `member` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";
       
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
        $query = "UPDATE  `member` SET "
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

    public function SelectForgetMember($email) {

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

    public function updateVerifyCode($code) {

        $query = "UPDATE  `member` SET "
                . "`verify_code` ='" . $code . "', "
                . "`is_verified` ='0' "
                . "WHERE `id` = '" . $this->id . "'";

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

    function sendVerificationMail($code) {
        
        require_once "Mail.php";

        $MEMBER = new Member($this->id);
        
        date_default_timezone_set('Asia/Colombo');
        $todayis = date("l, F j, Y, g:i a");

        $comany_name = "GambleB";
        $website_name = "www.gambleb.lk";
        $comConNumber = "+94771234567";
        $comEmail = "info@gambleb.lk";
        $site_link = "https://" . $_SERVER['HTTP_HOST'];

        //---------------------- SERVER WEBMAIL LOGIN ------------------------

        $host = "sg1-ls7.a2hosting.com";
        $username = "info@gambleb.lk";
        $password = 'IT5U4!CoJdK{';

//------------------------ MAIL ESSENTIALS --------------------------------

        $webmail = "info@gambleb.lk";
        $visitorSubject = "Verify Your Email";

        $html = '<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>GambleB Email</title>
    </head>
    <body>
        <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f8fb"> 
            <tbody>
                <tr> 
                    <td style="padding-top:10px;padding-bottom:30px;padding-left:16px;padding-right:16px" align="center"> 
                        <table style="width:602px" width="602" cellspacing="0" cellpadding="0" border="0" align="center"> 
                            <tbody>
                                <tr> 
                                    <td bgcolor=""> 
                                        <table width="642" cellspacing="0" cellpadding="0" border="0"> 
                                            <tbody> 
                                                <tr> 
                                                    <td style="border:1px solid #dcdee3;padding:20px;background-color:#fff;width:600px" width="600px" bgcolor="#ffffff" align="center"> 
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
                                                            <tbody>
                                                                <tr><td>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="100%">
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 0px;">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td valign="middle" height="46" align="right">
                                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td width="100%" align="center">
                                                                                                                        <font style="font-family:Verdana,Geneva,sans-serif;color:#68696a;font-size:18px">
                                                                                                                            <a href="' . $site_link . '" style="color:#68696a;text-decoration:none;" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://www.gallecabsandtours.com&amp;source=gmail&amp;ust=1574393192616000&amp;usg=AFQjCNGNM8_Z7ZMe7ndwFlJuHEP29nDd3Q">
                                                                                                                                <h4>' . $website_name . '</h4>
                                                                                                                            </a>
                                                                                                                        </font>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table>
                                                        <table style="background-color:#f5f7fa" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F5F7FA"> 
                                                            <tbody> 
                                                                <tr> 
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left"> 
                                                                        <b><p>Dear Member <br />Mr/Mrs/Miss/Dr/Rev. ' . $MEMBER->name . ',</p></b>
                                                                        <p>Thank you very much for join with us. A sign in attempt requires further verification. Use below code to verify your email.</p>
                                                                        <ul>
                                                                            <li><b>Verification Code:</b> ' . $code . '</li>
                                                                        </ul>
                                                                        <p style="margin-bottom:15px;"><a href="https://gambleb.synotec.lk/member/verify-email.php" style="padding: 10px; background: #9C27B0; color: #fff; text-decoration: none; text-transform: uppercase; font-weight: 600;">Click here to verify your email address</a></p> 
                                                                    </td>         
                                                                </tr> 
                                                                <tr>
                                                                    <td style="word-wrap:break-word;font-size:14px;color:#333;line-height:18px;font-family:Arial,Helvetica,sans-serif;padding:10px 20px" align="left">
                                                                        <p><b>Thanks & Best Regards!...</b></p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">This is an automated message, do not reply to this email.</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Email: info@gambleb.lk</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Phone: +94771234567</p>
                                                                        <p style="margin-bottom:0; margin-top: 3px; font-size: 12px;">Web: www.gambleb.lk</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody> 
                                                        </table> 
                                                    </td> 
                                                </tr> 
                                                <tr> 
                                                    <td style="padding:4px 20px;width:600px;line-height:12px">&nbsp;</td> 
                                                </tr> 
                                                
                                            </tbody> 
                                        </table>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </td> 
                </tr> 
            </tbody>
        </table>
    </body>
</html>';
        
        $visitorHeaders = array('MIME-Version' => '1.0', 'Content-Type' => "text/html; charset=ISO-8859-1", 'From' => $webmail,
            'To' => $MEMBER->email,
            'Reply-To' => $comEmail,
            'Subject' => $visitorSubject);

        
        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $visitorMail = $smtp->send($MEMBER->email, $visitorHeaders, $html);
        $arr = array();
        if (PEAR::isError($visitorMail)) {

            $arr['status'] = "Could not be sent your message";
        } else {
            $arr['status'] = "Your message has been sent successfully";
        }

        return $arr;
    }

}
