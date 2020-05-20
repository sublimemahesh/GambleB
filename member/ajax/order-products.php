<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '../auth.php');

if ($_POST["action"] == 'delete') {
    $ORDERPRODUCT = new OrderProduct($_POST["id"]);


    $result = $ORDERPRODUCT->delete();

    if ($result) {
        $result = ["status" => 'success'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'get_product') {

    $PRODUCT = new Product($_POST["id"]);

    if ($PRODUCT->id == null) {
        $result = ["status" => 'invalid'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    } else {
        echo json_encode($PRODUCT);
        header('Content-type: application/json');
        exit();
    }
}

if ($_POST['action'] == 'add_product') {

    $ORDERPRODUCT = new OrderProduct(null);
    $ORDERPRODUCT->order = $_POST['order'];
    $ORDERPRODUCT->product = $_POST['product'];
    $ORDERPRODUCT->qty = $_POST['quantity'];
    $ORDERPRODUCT->amount = $_POST['amount'];
    $result = $ORDERPRODUCT->create();

    if ($result) {
        $result = ["status" => $result];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    }
}


if ($_POST['action'] == 'edit_product') {

    $ORDERPRODUCT = new OrderProduct($_POST["edit_pro_id"]);
    $ORDERPRODUCT->order = $_POST['order'];
    $ORDERPRODUCT->product = $_POST['product'];
    $ORDERPRODUCT->qty = $_POST['quantity'];
    $ORDERPRODUCT->amount = $_POST['amount'];
    $result = $ORDERPRODUCT->update();

    if ($result) {
        $result = ["status" => 'sucess'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    } else {
        $result = ["status" => 'error'];
        echo json_encode($result);
        header('Content-type: application/json');
        exit();
    }
}

