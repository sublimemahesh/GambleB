<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if (isset($_POST['create'])) {

    $PRODUCT = new Product(NULL);
    $VALID = new Validator();

    $PRODUCT->category = $_POST['category'];
    $PRODUCT->sub_category = $_POST['id'];
    $PRODUCT->brand = $_POST['brand'];
    $PRODUCT->name = $_POST['name'];
    $PRODUCT->discount = $_POST['discount'];
    $PRODUCT->unite = $_POST['unite'];
    $PRODUCT->price = $_POST['price'];
    $PRODUCT->short_description = $_POST['short_description'];
    $PRODUCT->description = $_POST['description'];
    $PRODUCT->in_stock = $_POST['in_stock'];
    $PRODUCT->min_qty = $_POST['min_qty'];
    $PRODUCT->max_qty = $_POST['max_qty'];

    $dir_dest = '../../upload/product-categories/sub-category/product/photos/';

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

    $PRODUCT->image_name = $imgName;

    $VALID->check($PRODUCT, [
        'name' => ['required' => TRUE],
        'brand' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT->create();

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

    $dir_dest = '../../upload/product-categories/sub-category/product/photos/';

    $handle = new Upload($_FILES['image']);

    $imgName = null;


    if ($handle->uploaded) {
        if (empty($_POST["oldImageName"])) {
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
            $handle->file_new_name_body = $_POST["oldImageName"];
        }

        $handle->image_x = 500;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        $PRODUCT_CATEGORIES->icon = $handle->file_dst_name;
    }



    $PRODUCT = new Product($_POST['id']);

    $PRODUCT->category = $_POST['category'];
    $PRODUCT->sub_category = $_POST['sub_category'];
    $PRODUCT->brand = $_POST['brand'];
    $PRODUCT->image_name = $_POST['oldImageName'];
    $PRODUCT->name = $_POST['name'];
    $PRODUCT->short_description = $_POST['short_description'];
    $PRODUCT->description = $_POST['description'];
    $PRODUCT->in_stock = $_POST['in_stock'];
    $PRODUCT->min_qty = $_POST['min_qty'];
    $PRODUCT->max_qty = $_POST['max_qty'];
    $PRODUCT->discount = $_POST['discount'];
    $PRODUCT->unite = $_POST['unite'];
    $PRODUCT->price = $_POST['price'];

    $VALID = new Validator();
    $VALID->check($PRODUCT, [
        'brand' => ['required' => TRUE],
        'name' => ['required' => TRUE],
        'short_description' => ['required' => TRUE],
        'description' => ['required' => TRUE],
        'image_name' => ['required' => TRUE]
    ]);

    if ($VALID->passed()) {
        $PRODUCT->update();

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

        $PRODUCT = Product::arrange($key, $img);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}