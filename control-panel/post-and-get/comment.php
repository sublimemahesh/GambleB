<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $COMMENT = new Comments(NULL);
    $VALID = new Validator();

    $COMMENT->name = $_POST['name'];
    $COMMENT->title = $_POST['title'];
    $COMMENT->city = $_POST['city'];
    $COMMENT->comment = $_POST['comment'];
    $COMMENT->is_active = $_POST['active'];

    $dir_dest = '../../upload/comments/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 150;
        $handle->image_y = 150;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $COMMENT->image_name = $imgName;

    $VALID->check($COMMENT, [
        'name' => ['required' => TRUE],        
        'image_name' => ['required' => TRUE],        
        'comment' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $COMMENT->create();

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
    $dir_dest = '../../upload/comments/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $_POST ["oldImageName"];
        $handle->image_x = 150;
        $handle->image_y = 150;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $COMMENT = new Comments($_POST['id']);

    $COMMENT->image_name = $_POST['oldImageName'];
    $COMMENT->name = $_POST['name'];
    $COMMENT->title = $_POST['title'];
    $COMMENT->city = $_POST['city'];
    $COMMENT->comment = $_POST['comment'];
    $COMMENT->is_active = $_POST['active'];

    $VALID = new Validator();
    $VALID->check($COMMENT, [
        'image_name' => ['required' => TRUE],
        'name' => ['required' => TRUE],     
        'comment' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $COMMENT->update();

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

        $COMMENT = Comments::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}