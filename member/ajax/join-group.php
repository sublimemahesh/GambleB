<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$GROUPMEM = new GroupMember(NULL);

$GROUPMEM->group = $_POST['group'];
$GROUPMEM->member = $_POST['member'];


$VALID = new Validator();
$VALID->check($GROUPMEM, [
    'group' => ['required' => TRUE],
    'member' => ['required' => TRUE]
]);

if ($VALID->passed()) {
    $GROUPMEM->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} else {

    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}

