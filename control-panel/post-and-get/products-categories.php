<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $PRODUCT_CATEGORIES = new ProductCategories(NULL);
    $VALID = new Validator();

    $PRODUCT_CATEGORIES->name = $_POST['name'];

    $dir_dest = '../../upload/product-categories/icon/';

    $handle = new Upload($_FILES['icon']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 600;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PRODUCT_CATEGORIES->icon = $imgName;


    $dir_dest_banner = '../../upload/product-categories/banner/';

    $handle = new Upload($_FILES['banner']);

    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = Helper::randamId();
        $handle->image_x = 870;
        $handle->image_y = 150;

        $handle->Process($dir_dest_banner);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $PRODUCT_CATEGORIES->banner = $imgName;

    $VALID->check($PRODUCT_CATEGORIES, [
        'name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT_CATEGORIES->create();

        if (!isset($_SESSION)) {
            session_start();
        }
        $VALID->addError("Your data was saved successfully", 'success');
        $_SESSION['ERRORS'] = $VALID->errors();
        header("location: ../create-sub-category.php?id=" . $PRODUCT_CATEGORIES->id);
    } else {

        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['ERRORS'] = $VALID->errors();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['update'])) {

    $PRODUCT_CATEGORIES = new ProductCategories($_POST['id']);

    $dir_dest = '../../upload/product-categories/icon/';

    $handle = new Upload($_FILES['icon']);
    if ($handle->uploaded) {
        if (empty($_POST["oldImageIcon"])) {
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
            $handle->file_new_name_body = $_POST["oldImageIcon"];
        }

        $handle->image_x = 600;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        $PRODUCT_CATEGORIES->icon = $handle->file_dst_name;
    }

    $dir_dest_banner = '../../upload/product-categories/banner/';

    $handle = new Upload($_FILES['banner']);
    if ($handle->uploaded) {
        if (empty($_POST["oldImageBanner"])) {
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
            $handle->file_new_name_body = $_POST["oldImageBanner"];
        }

        $handle->image_x = 870;
        $handle->image_y = 150;

        $handle->Process($dir_dest_banner);

        $PRODUCT_CATEGORIES->banner = $handle->file_dst_name;
    }

    $PRODUCT_CATEGORIES->name = $_POST['name'];


    $VALID = new Validator();
    $VALID->check($PRODUCT_CATEGORIES, [
        'name' => ['required' => TRUE],
    ]);

    if ($VALID->passed()) {
        $PRODUCT_CATEGORIES->update();

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

        $PRODUCT_CATEGORIES = ProductCategories::arrange($key, $img);
        header("location: ../arrange-product-categories.php?message=9");
        
    }
}