<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $PRODUCT_TYPE = new ProductType(NULL);
    $VALID = new Validator();

    $PRODUCT_TYPE->name = $_POST['name'];
    $PRODUCT_TYPE->short_description = $_POST['short_description'];
    $PRODUCT_TYPE->description = $_POST['description'];

    $dir_dest = '../../upload/product-type/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PRODUCT_TYPE->image_name = $imgName;

    $VALID->check($PRODUCT_TYPE, [
        'name' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT_TYPE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header("location: ../view-products.php?id=" . $PRODUCT_TYPE->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['update'])) {
    $dir_dest = '../../upload/product-type/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PRODUCT_TYPE = new ProductType(NULL);

    $PRODUCT_TYPE->id = $_POST['id'];
    $PRODUCT_TYPE->image_name = $_POST['oldImageName'];
    $PRODUCT_TYPE->name = $_POST['name'];
    $PRODUCT_TYPE->short_description = $_POST['short_description'];
    $PRODUCT_TYPE->description = $_POST['description'];

    $VALID = new Validator();
    $VALID->check($PRODUCT_TYPE, [
        'name' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT_TYPE->update();

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

        $PRODUCT_TYPE = ProductType::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}