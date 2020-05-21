<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
session_start();

if ($_POST['option'] == 'CHANGEPASSWORD') {

    $OldPassOk = Member::checkOldPass($_SESSION["id"], $_POST["old_pass"]);

    if ($OldPassOk) {
        $result = Member::changePassword($_SESSION["id"], $_POST["new_pass"]);
        if ($result == 'TRUE') {
            $data = array("status" => TRUE);
            header('Content-type: application/json');
            echo json_encode($data);
        } else {
            $data = array("status" => 'error1');
            header('Content-type: application/json');
            echo json_encode($data);
        }
    } else {
        $data = array("status" => 'error2');
        header('Content-type: application/json');
        echo json_encode($data);
    }
}