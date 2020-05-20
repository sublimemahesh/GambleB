<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['option'] == 'success') {
    $ORDER = new Order($_POST['id']);
    $ORDER->paymentStatusCode = 2;
    $result = $ORDER->updatePaymentStatusCode();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'unsuccess') {
    $ORDER = new Order($_POST['id']);
    $ORDER->paymentStatusCode = 0;
    $result = $ORDER->updatePaymentStatusCode();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
if ($_POST['option'] == 'refund') {
    $ORDER = new Order($_POST['id']);
    $ORDER->paymentStatusCode = 4;
    $result = $ORDER->updatePaymentStatusCode();

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
