<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'delivered') {
    $ORDER = new Order($_POST['id']);

    $result = $ORDER->markAsDelivered();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'completed') {
    $ORDER = new Order($_POST['id']);

    $result = $ORDER->markAsCompleted();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'cancel') {
    $ORDER = new Order($_POST['id']);

    $result = $ORDER->cancelOrder();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'pay') {
    $ORDER = new Order($_POST['id']);

    $ORDER->paymentStatusCode = 2;
    $ORDER->status = 1;

    $result = $ORDER->updatePaymentStatusCodeAndStatus();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}

