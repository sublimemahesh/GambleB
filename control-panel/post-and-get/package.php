<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $PACKAGE = new Package(NULL);
    $VALID = new Validator();

    $PACKAGE->category = $_POST['category'];
    $PACKAGE->sub_category = $_POST['sub_category'];
    $PACKAGE->name = $_POST['name'];
    $PACKAGE->price = $_POST['price'];
    $PACKAGE->discount = $_POST['discount'];
    $PACKAGE->product_list = $_POST['product_list'];
    $PACKAGE->description = $_POST['description'];

    $dir_dest = '../../upload/package/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 500;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PACKAGE->image_name = $imgName;

    $VALID->check($PACKAGE, [
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $PACKAGE->create();

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
   $dir_dest = '../../upload/package/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 500;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PACKAGE = new Package($_POST['id']);

    $PACKAGE->category = $_POST['category'];
    $PACKAGE->sub_category = $_POST['sub_category'];
    $PACKAGE->name = $_POST['name'];
    $PACKAGE->price = $_POST['price'];
    $PACKAGE->discount = $_POST['discount'];
    $PACKAGE->product_list = $_POST['product_list'];
    $PACKAGE->description = $_POST['description'];
    $PACKAGE->image_name = $_POST ["oldImageName"];


    $VALID = new Validator();

    $VALID->check($PACKAGE, [
        'name' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);


    if ($VALID->passed()) {
        $PACKAGE->update();

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

        $PACKAGE = Offer::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}