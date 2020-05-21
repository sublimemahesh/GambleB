<?php

/**

 * Description of User

 *

 * @author sublime holdings

 * @web www.sublime.lk

 * */
class Database {

//    private $host = 'localhost';
//    private $name = 'synoteca_gambleb';
//    private $user = 'synoteca_main';
//    private $password = '3rTI#)-vDmAKczXQ-J';

    private $host = 'localhost';
    private $name = 'gambleb';
    private $user = 'root';
    private $password = '';

    public function __construct() {

        mysql_connect($this->host, $this->user, $this->password) or die("Invalid host  or user details");

        mysql_select_db($this->name) or die("Unable to select database");
    }

    public function readQuery($query) {



        $result = mysql_query($query) or die(mysql_error());

        return $result;



//        $qu1 = explode(" ", $query)[0];
//
//        if ($qu1 === 'SELECT' || $qu1 === 'select') {
//            $result = mysql_query($query) or die(mysql_error());
//            return $result;
//        } else {
//            if (!isset($_SESSION)) {
//                session_start();
//            }
//
//            if (
//                    $_SESSION["LOGIN"] === true &&
//                    parse_url($_SERVER['HTTP_REFERER'])["host"] == $this->domain &&
//                    $_SESSION['TOKEN'] == 'Vr-EFV!Fn6qCCUHYF2&cFzLw_thehorizonvilla-H5Dx'
//            ) {
//
//                $result = mysql_query($query) or die(mysql_error());
//                return $result;
//            } else {
//                sendSecurityAlert($this->domain);
//            }
//        }
    }

}
