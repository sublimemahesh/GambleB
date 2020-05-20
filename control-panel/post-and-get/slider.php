<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $SLIDER = new Slider(NULL);
    $VALID = new Validator();

    $SLIDER->title = $_POST['title'];
    $SLIDER->description = $_POST['description'];
    $SLIDER->url =  $_POST['url'];

    $dir_dest = '../../upload/slider/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 1350;
        $handle->image_y = 650;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $SLIDER->image_name = $imgName;

    $VALID->check($SLIDER, [
        'title' => ['required' => TRUE],
        'description' => ['required' => TRUE],        
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $SLIDER->create();

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
    $dir_dest = '../../upload/slider/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 1350;
        $handle->image_y = 650;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $SLIDER = new Slider($_POST['id']);

    $SLIDER->image_name = $_POST['oldImageName'];
    $SLIDER->title = $_POST['title'];
    $SLIDER->description = $_POST['description'];
    $SLIDER->url = $_POST['url'];


    $VALID = new Validator();
    $VALID->check($SLIDER, [
        'title' => ['required' => TRUE],
        'description' => ['required' => TRUE],      
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $SLIDER->update();

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


if (isset($_POST['save-date'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;
        
        $SLIDER = Slider::arrange($key, $img);
        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}