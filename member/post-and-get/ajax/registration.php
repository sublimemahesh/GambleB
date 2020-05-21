<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

session_start();
$MEMBER = new Member(NULL);
header('Content-type: application/json');

$MEMBER->name = $_POST['name'];
$MEMBER->phone_number = $_POST['phone'];
$MEMBER->email = $_POST['email'];
$MEMBER->password = md5($_POST['password']);


$checkEmail = $MEMBER->checkEmail($_POST['email']);

if (!$checkEmail) {
    $MEMBER->create();
    if ($MEMBER->id) {
        $code = Helper::getVerifyCode();
        $MEMBER->updateVerifyCode($code);
        $MEMBER->sendVerificationMail($code);
        $data = $MEMBER->login($MEMBER->email, $MEMBER->password);

        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $redirect = '';
        $result = ["status" => 'error', 'redirect' => $redirect];
        echo json_encode($result);
        exit();
    }
} else {
    $result = ["status" => 'emailex'];
    echo json_encode($result);
    exit();
}
?>
 
