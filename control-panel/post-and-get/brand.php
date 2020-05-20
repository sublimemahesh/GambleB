<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $BRAND = new Brand(NULL);
    $VALID = new Validator();

    $BRAND->name = $_POST['name'];

    $dir_dest = '../../upload/product-categories/product/brands/logo/';

    $handle = new Upload($_FILES['logo']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $BRAND->logo = $imgName;

 

    $VALID->check($BRAND, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $BRAND->create();

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

    $BRAND = new Brand($_POST['id']);

    $dir_dest = '../../upload/product-categories/product/brands/logo/';

    $handle = new Upload($_FILES['logo']);
    if ($handle->uploaded) {
        if (empty($_POST["oldImageLogo"])) {
            $handle->image_resize = true;
            $handle->file_new_name_ext = 'jpg';
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = Helper::randamId();
        } else {
            $handle->image_resize = true;
            $handle->file_new_name_body = TRUE;
            $handle->file_overwrite = TRUE;
            $handle->file_new_name_ext = FALSE;
            $handle->image_ratio_crop = 'C';
            $handle->file_new_name_body = $_POST["oldImageLogo"];
        }

        $handle->image_x = 250;
        $handle->image_y = 250;

        $handle->Process($dir_dest);

        $BRAND->logo = $handle->file_dst_name;
    } 

    $BRAND->name = $_POST['name'];


    $VALID = new Validator();
    $VALID->check($BRAND, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $BRAND->update();

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

        $BRAND = Brand::arrange($key, $img);
        header("location: ../arrange-brand.php?message=9");
        
    }
}