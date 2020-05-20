<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '../auth.php');

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['city'])) {
    $DEALERAREA = new DealerArea(null);

    $DEALERAREA->city = $_POST['city'];
    $DEALERAREA->dealer = $_SESSION["d_id"];


    $VALID = new Validator();

    $VALID->check($DEALERAREA, [
        'city' => ['required' => TRUE],
        'dealer' => ['required' => TRUE]
    ]);

    $exists = $DEALERAREA->checkExists();

    if (!$exists) {
        if ($VALID->passed()) {
            $DEALERAREA->create();

            $result = ["status" => 'success'];
            echo json_encode($result);
            exit();
        } else {

            $result = ["status" => 'error'];
            echo json_encode($result);
            exit();
        }
    } else {
        $result = ["status" => 'exist'];
        echo json_encode($result);
        exit();
    }
}



if ($_POST['action'] == 'delete') {
    $DEALERAREA = new DealerArea($_POST['id']);
 
    $result = $DEALERAREA->delete();
 
    if ($result) {
        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
}

