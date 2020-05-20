<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $SERVICE = new Service(NULL);
    $VALID = new Validator();

    $SERVICE->title =$_POST['title'];
    $SERVICE->short_description = $_POST['short_description'];
    $SERVICE->description = $_POST['description'];

    $dir_dest = '../../upload/service/';

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

    $SERVICE->image_name = $imgName;

    $VALID->check($SERVICE, [
        'title' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
    ]);


    if ($VALID->passed()) {
        $SERVICE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

        header("location: ../view-service-photos.php?id=" . $SERVICE->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
//    $result = $SERVICE->create();
//      if ($result) {
//        header("location: ../create-service.php?id=" . $SERVICE->id."&&message=10");
//    } else {
//        
//    }
}

if (isset($_POST['update'])) {
    $dir_dest = '../../upload/service/';

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

    $SERVICE = new Service($_POST['id']);

    $SERVICE->image_name = $_POST['oldImageName'];
    $SERVICE->title = $_POST['title'];
    $SERVICE->short_description = $_POST['short_description'];
    $SERVICE->description = $_POST['description'];

    $VALID = new Validator();

    $VALID->check($SERVICE, [
        'title' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
    ]);


    if ($VALID->passed()) {
        $SERVICE->update();

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

        $SERVICE = Service::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}