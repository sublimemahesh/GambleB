<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $PRODUCT = new Product($_POST['id']);

    unlink(Helper::getSitePath() . "upload/product-categories/sub-category/product/photos/" . $PRODUCT->image_name);
  

    $result = $PRODUCT->delete();

    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}