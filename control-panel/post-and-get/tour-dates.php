<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $TOUR_DATE = new TourDate(NULL);
    $VALID = new Validator();

    $TOUR_DATE->tour = $_POST['id'];
    $TOUR_DATE->title =  $_POST['title'] ;
    $TOUR_DATE->description =  $_POST['description'] ;

    $dir_dest = '../../upload/tour-package/date/';
    $dir_dest_thumb = '../../upload/tour-package/date/thumb/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;
    $img = Helper::randamId();

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }


        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 300;
        $handle->image_y = 175;

        $handle->Process($dir_dest_thumb);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $TOUR_DATE->image_name = $imgName;

    $VALID->check($TOUR_DATE, [
        'title' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
        'description' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $TOUR_DATE->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();

         header("location: ../view-tour-date-photos.php?id=" .$TOUR_DATE->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['update'])) {

    $dir_dest = '../../upload/tour-package/date/';
    $dir_dest_thumb = '../../upload/tour-package/date/thumb/';

    $handle = new Upload($_FILES['image']);

    $img = $_POST ["oldImageName"];

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 900;
        $handle->image_y = 500;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $img = $handle->file_dst_name;
        }


        $handle->image_resize = true;
        $handle->file_new_name_body = TRUE;
        $handle->file_overwrite = TRUE;
        $handle->file_new_name_ext = FALSE;
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $img;
        $handle->image_x = 300;
        $handle->image_y = 175;

        $handle->Process($dir_dest_thumb);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $img = $handle->file_dst_name;
        }
    }

    $TOUR_DATE = new TourDate($_POST['id']);

    $TOUR_DATE->image_name = $_POST['oldImageName'];
    $TOUR_DATE->title = filter_input(INPUT_POST, 'title');
    $TOUR_DATE->description = filter_input(INPUT_POST, 'description');

    $VALID = new Validator();
    $VALID->check($TOUR_DATE, [
        'title' => ['required' => TRUE],
        'image_name' => ['required' => TRUE],
        'description' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $TOUR_DATE->update();

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

        $TOUR_DATE = TourDate::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}