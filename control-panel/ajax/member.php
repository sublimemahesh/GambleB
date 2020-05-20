<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if ($_POST['option'] == 'suspend') {
    $MEMBER = new Member($_POST['id']);
    $MEMBER->isActive = 0;
    $result = $MEMBER->updateMemberStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'active') {
    $MEMBER = new Member($_POST['id']);
    $MEMBER->isActive = 1;
    $result = $MEMBER->updateMemberStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}