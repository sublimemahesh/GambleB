<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

 
$ADD_TO_CART = new AddToCart($_POST['id']);
$ADD_TO_CART->status = $_POST['type'];
$result = $ADD_TO_CART->update();

echo json_encode($result);
header('Content-type: application/json');
exit();

