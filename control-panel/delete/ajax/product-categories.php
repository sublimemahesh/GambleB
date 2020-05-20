<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $PRODUCT_CATEGORIES = new ProductCategories($_POST['id']);
    $result = $PRODUCT_CATEGORIES->delete();
    if ($result) {
        $subcateegories = SubCategory::getProductsByCategory($_POST['id']);
        foreach ($subcateegories as $subcateegory) {
            $SUBCATEGORY = new SubCategory(NULL);
            $SUBCATEGORY->id = $subcateegory['id'];
            $SUBCATEGORY->image_name = $subcateegory['image_name'];
            $SUBCATEGORY->delete();
        }
    }

    if ($result) {
        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}