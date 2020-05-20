<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['pay_now'])) {

    $ORDER = new Order(NULL);
    $VALID = new Validator();

    date_default_timezone_set('Asia/Colombo');
    $orderedAt = date('Y-m-d H:i:s');

    $ORDER->orderedAt = $orderedAt;
    $ORDER->firstName = $_POST['first_name'];
    $ORDER->lastName = $_POST['last_name'];
    $ORDER->email = $_POST['email'];
    $ORDER->phoneNumber = $_POST['phone_number'];
    $ORDER->address = $_POST['address'];
    $ORDER->city = $_POST['city'];
    $ORDER->country = $_POST['country'];
    $ORDER->postalCode = $_POST['postal_code'];
    $ORDER->product = $_POST['product'];
    $ORDER->qty = $_POST['qty'];
    $ORDER->amount = $_POST['amount'];
    $ORDER->status = 0;
    $ORDER->paymentStatusCode = 0;
    $ORDER->deliveryStatus = 0;
    $ORDER->deliveredAt = '0000-00-00';
    $ORDER->completedAt = '0000-00-00';


    $VALID->check($ORDER, [
        'firstName' => ['required' => TRUE],
        'lastName' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'phoneNumber' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'country' => ['required' => TRUE],
        'product' => ['required' => TRUE],
        'qty' => ['required' => TRUE],
        'amount' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $result = $ORDER->create();

        if ($result) {
            $ORD = new Order($result);
            $ORD->status = 1;
            $ORD->paymentStatusCode = 2;
            $res = $ORD->updatePaymentStatusCodeAndStatus();
        }
        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['pay_later'])) {

    $ORDER = new Order(NULL);
    $VALID = new Validator();

    date_default_timezone_set('Asia/Colombo');
    $orderedAt = date('Y-m-d H:i:s');

    $ORDER->orderedAt = $orderedAt;
    $ORDER->firstName = $_POST['first_name'];
    $ORDER->lastName = $_POST['last_name'];
    $ORDER->email = $_POST['email'];
    $ORDER->phoneNumber = $_POST['phone_number'];
    $ORDER->address = $_POST['address'];
    $ORDER->city = $_POST['city'];
    $ORDER->country = $_POST['country'];
    $ORDER->postalCode = $_POST['postal_code'];
    $ORDER->product = $_POST['product'];
    $ORDER->qty = $_POST['qty'];
    $ORDER->amount = $_POST['amount'];
    $ORDER->status = 0;
    $ORDER->paymentStatusCode = 0;
    $ORDER->deliveryStatus = 0;
    $ORDER->deliveredAt = '0000-00-00';
    $ORDER->completedAt = '0000-00-00';

    $VALID->check($ORDER, [
        'firstName' => ['required' => TRUE],
        'lastName' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'phoneNumber' => ['required' => TRUE],
        'address' => ['required' => TRUE],
        'city' => ['required' => TRUE],
        'country' => ['required' => TRUE],
        'product' => ['required' => TRUE],
        'qty' => ['required' => TRUE],
        'amount' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $result = $ORDER->create();
        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['ERRORS'] = $VALID->errors();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}