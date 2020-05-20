<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$GROUP = new Group(NULL);

$GROUP->game = $_POST['game'];
$GROUP->end_date_time = $_POST['end_date_time'];
$GROUP->member = $_POST['member'];
$GROUP->status = 'active';


$VALID = new Validator();
$VALID->check($GROUP, [
    'game' => ['required' => TRUE],
    'end_date_time' => ['required' => TRUE]
]);

if ($VALID->passed()) {
    $GROUP->create();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} else {

    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}

