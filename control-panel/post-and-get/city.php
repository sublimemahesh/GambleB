<?php

include_once(dirname(__FILE__) . '/../../class/include.php');
include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['create'])) {

    $CITY = New City(NULL);
    $VALID = new Validator();

    $CITY->district = $_POST['id'];
    $CITY->name = $_POST['name'];

    $VALID->check($CITY, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $CITY->create();

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

if (isset($_POST['edit-city'])) {

    $CITY = New City($_POST['id']);
    $VALID = new Validator();

    $CITY->name = $_POST['name'];

    $VALID->check($CITY, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $CITY->update();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your changes saved successfully", 'success');
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

if (isset($_POST['save-arrange'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $CITY = City::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

