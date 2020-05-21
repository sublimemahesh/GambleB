<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

$MEMBER = new Member(NULL);

$code = $_POST["reset_code"];
$password = $_POST["new_pass"];

 
if ($MEMBER->SelectResetCode($code)) {
    
    $MEMBER->updatePassword($password, $code);
    
    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} else {
    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}
?>