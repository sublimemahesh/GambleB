<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-country'])) {
    $COUNTRY = new Country(NULL);
    $VALID = new Validator();

    $COUNTRY->name = $_POST['name'];

    $VALID->check($COUNTRY, ['name' =>
        ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $COUNTRY->create();

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

if (isset($_POST['update'])) {
    $COUNTRY = new Country($_POST['id']);

    $COUNTRY->name = $_POST['name'];

    $VALID = new Validator();
    $VALID->check($COUNTRY, ['name' =>
        ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $COUNTRY->update();

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

        $COUNTRY = Country::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}