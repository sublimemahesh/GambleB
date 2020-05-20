<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$GROUP = new Group($_POST['id']);

$GROUP->game = $_POST['game'];
$GROUP->end_date_time = $_POST['end_date_time'];
$GROUP->member = $_POST['member'];

if($_POST['status']) {
    $GROUP->status = 'active';
} else {
    $GROUP->status = 'inactive';
}
$VALID = new Validator();
$VALID->check($GROUP, [
    'game' => ['required' => TRUE],
    'end_date_time' => ['required' => TRUE]
]);

if ($VALID->passed()) {
    $GROUP->update();

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
} else {

    $result = ["status" => 'error'];
    echo json_encode($result);
    exit();
}

