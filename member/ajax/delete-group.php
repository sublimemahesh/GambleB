<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


if ($_POST['option'] == 'delete') {
    $GROUP = new Group($_POST['id']);

    $result = $GROUP->delete();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}