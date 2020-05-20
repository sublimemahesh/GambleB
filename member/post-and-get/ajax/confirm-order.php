<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . './auth.php');

header('Content-type: application/json');

if ($_POST['action'] == 'ASSIGNDEALER') {
    $ORDER = new Order($_POST['id']);
    if ($ORDER->dealer == 0) {
        $ORDER->dealer = $_POST['dealer'];
        $result = $ORDER->assignDealer();
        if($result) {
            
            $ORDER->sendOrderConfirmationMailToCustomer();
        }

        $data = array("status" => "success");
        echo json_encode($data);
    } else {
        $data = array("status" => "already_assigned");
        echo json_encode($data);
    }
}

if ($_POST['action'] == 'COMPLETEORDER') {
    $ORDER = new Order($_POST['id']);
    $result = $ORDER->markAsCompleted();

    $data = array("status" => "success");
    echo json_encode($data);
}

if ($_POST['action'] == 'CANCLEORDER') {
    $ORDER = new Order($_POST['id']);
    $result = $ORDER->markAsCancled();

    $data = array("status" => "success");
    echo json_encode($data);
}