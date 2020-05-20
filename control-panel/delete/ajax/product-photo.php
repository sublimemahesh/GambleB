<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $PRODUCT_PHOTO = new ProductPhoto($_POST['id']);

    unlink('../../../upload/product-categories/sub-category/product/photos/gallery/' . $PRODUCT_PHOTO->image_name);
    unlink('../../../upload/product-categories/sub-category/product/photos/gallery/thumb/' . $PRODUCT_PHOTO->image_name);

    $result = $PRODUCT_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}