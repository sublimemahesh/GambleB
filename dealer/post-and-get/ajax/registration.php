<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');

session_start();
$DEALER = new Dealer(NULL);


$DEALER->name = $_POST['name'];
$DEALER->phone = $_POST['phone'];
$DEALER->email = $_POST['email'];
$DEALER->password = md5($_POST['password']);


$checkEmail = $DEALER->checkEmail(null, $_POST['email']);

if (!$checkEmail) {
    $DEALER->create();
    if ($DEALER->id) {

        $data = $DEALER->login($DEALER->email, $DEALER->password);

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
 
