<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $CUSTOMER = new Customer(NULL);
    $VALID = new Validator();

    $CUSTOMER->name = $_POST['name'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->password = md5($_POST['password']);
    $CUSTOMER->phone_number = $_POST['phone_number'];
    $CUSTOMER->district = $_POST['district'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->address = $_POST['address'];


//    $dir_dest = '../../upload/product-categories/product/brands/logo/';
//
//    $handle = new Upload($_FILES['logo']);
//
//    $imgName = null;
//
//    if ($handle->uploaded) {
//        $handle->image_resize = true;
//        $handle->file_new_name_ext = 'jpg';
//        $handle->image_ratio_crop = 'C';
//        $handle->file_new_name_body = Helper::randamId();
//        $handle->image_x = 250;
//        $handle->image_y = 250;
//
//        $handle->Process($dir_dest);
//
//        if ($handle->processed) {
//            $info = getimagesize($handle->file_dst_pathname);
//            $imgName = $handle->file_dst_name;
//        }
//    }
//
//    $CUSTOMER->logo = $imgName;



    $VALID->check($CUSTOMER, [
        'name' => ['required' => TRUE],
        'email' => ['required' => TRUE],
        'password' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->create();

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

    $CUSTOMER = new Customer($_POST['id']);

//    $dir_dest = '../../upload/product-categories/product/brands/logo/';
//
//    $handle = new Upload($_FILES['logo']);
//    if ($handle->uploaded) {
//        if (empty($_POST["oldImageLogo"])) {
//            $handle->image_resize = true;
//            $handle->file_new_name_ext = 'jpg';
//            $handle->image_ratio_crop = 'C';
//            $handle->file_new_name_body = Helper::randamId();
//        } else {
//            $handle->image_resize = true;
//            $handle->file_new_name_body = TRUE;
//            $handle->file_overwrite = TRUE;
//            $handle->file_new_name_ext = FALSE;
//            $handle->image_ratio_crop = 'C';
//            $handle->file_new_name_body = $_POST["oldImageLogo"];
//        }
//
//        $handle->image_x = 250;
//        $handle->image_y = 250;
//
//        $handle->Process($dir_dest);
//
//        $CUSTOMER->logo = $handle->file_dst_name;
//    }

    $CUSTOMER->name = $_POST['name'];
    $CUSTOMER->email = $_POST['email'];
    $CUSTOMER->password = md5($_POST['password']);
    $CUSTOMER->phone_number = $_POST['phone_number'];
    $CUSTOMER->district = $_POST['district'];
    $CUSTOMER->city = $_POST['city'];
    $CUSTOMER->address = $_POST['address'];


    $VALID = new Validator();
    $VALID->check($CUSTOMER, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $CUSTOMER->update();

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

        $CUSTOMER = Brand::arrange($key, $img);
        header("location: ../arrange-brand.php?message=9");
    }
}