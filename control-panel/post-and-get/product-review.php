<?php

include_once(dirname(__FILE__) . '/../../class/include.php');



if (isset($_POST['update'])) { 

    $PRODUCT_REVIEW = new ProductReview($_POST['id']);

    $PRODUCT_REVIEW->title = $_POST['title'];
    $PRODUCT_REVIEW->stars = $_POST['stars'];
    $PRODUCT_REVIEW->description = $_POST['description'];
    $PRODUCT_REVIEW->is_active = $_POST['active'];

    $VALID = new Validator();
    $VALID->check($PRODUCT_REVIEW, [
        'title' => ['required' => TRUE],
        'is_active' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT_REVIEW->update();

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

if (isset($_POST['save-data'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $ACTIVITY_PHOTO = AttractionPhoto::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}