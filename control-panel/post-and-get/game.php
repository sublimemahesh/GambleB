<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

include_once(dirname(__FILE__) . '/../auth.php');


if (isset($_POST['add-game'])) {
    $GAME = new Game(NULL);
    $VALID = new Validator();

    $GAME->name = $_POST['name'];

    $VALID->check($GAME, ['name' =>
        ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $GAME->create();

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
    $GAME = new Game($_POST['id']);

    $GAME->name = $_POST['name'];

    $VALID = new Validator();
    $VALID->check($GAME, ['name' =>
        ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $GAME->update();

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