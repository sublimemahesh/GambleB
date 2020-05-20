<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

//Get Product by category
if ($_POST['action'] == 'GETPRODUCTBYCATEGORY') {

    $PRODUCT = new Product(NULL);

    $result = $PRODUCT->getProductsByCategory($_POST["proCategoryID"]);

    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}

//GEt subcategory product
if ($_POST['action'] == 'GETSUBPRODUCTBYCATEGORY') {

    $SUB_CATEGORY = new SubCategory(NULL);

    $result = $SUB_CATEGORY->getProductsByCategory($_POST["proCategoryID"]);

    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}

//Confirm order
if ($_POST['action'] == 'CONFIRM') {

    $ADD_TO_CART = new AddToCart($_POST['id']);
    $ADD_TO_CART->status = 'confirmed';
    $result = $ADD_TO_CART->update();
    
    
    $CUSTOMER = new Customer($_POST['customer']);

    $comany_name = "Supirimarket.lk";
    $website_name = "www.supirimarket.lk";
    $comConNumber = "+94 7575 111 49 /  +94 9122 487 94 ";
    $comEmail = "info@islandwide.website";
    $from = 'info@islandwide.website';



    $product_details = json_encode($product_array);

    $visitor_email = $CUSTOMER->email;
    $visitor_name = $CUSTOMER->name;
    $id= $_POST['id'];


    $find_us = 'test';

    $subject = 'Contact Message - Supirimarket.lk';
    $subject2 = 'Your order have been successfully confirmed by supirimirket.lk ';

    $message = 'Message';


    $headers = "From: " . $from . "\r\n";

    $headers .= "Reply-To: " . $visitor_email . "\r\n";

    $headers .= "MIME-Version: 1.0\r\n";

    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



    $headers1 = "From: " . $from . "\r\n";

    $headers1 .= "Reply-To: " . $comEmail . "\r\n";

    $headers1 .= "MIME-Version: 1.0\r\n";

    $headers1 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


    $company_message = 'Message';
// Sending mail
    $visitor_message = 'Message';

    include("confirm-order-mail-template.php");

    if (
            mail($comEmail, $subject, $company_message, $headers) &&
            mail($visitor_email, $subject2, $visitor_message, $headers1)
    ) {

        $response['status'] = 'correct';

        $response['msg'] = "Your message has been sent successfully";

//"Your message has been sent successfully"

        echo json_encode($response);

        exit();
    } else {

        $response['status'] = 'correct';

        $response['msg'] = "Could not be sent your message";

        echo json_encode($response);

        exit();
    } 

    $result = ["status" => 'success'];
    echo json_encode($result);
    exit();
}

//Cancel order
if ($_POST['action'] == 'CANCEL') {

    $ADD_TO_CART = new AddToCart($_POST['id']);
    $ADD_TO_CART->status = 'canceled';
    $result = $ADD_TO_CART->update();

    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}

//Deliver order
if ($_POST['action'] == 'DELIVER') {

    $ADD_TO_CART = new AddToCart($_POST['id']);
    $ADD_TO_CART->status = $_POST['type'];
    $result = $ADD_TO_CART->update();

    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}

//GEt subcategory product
if ($_POST['action'] == 'GETSUBCATEGORIESBYCATEGORY') {

    $SUB_CATEGORY = new SubCategory(NULL);

    $result = $SUB_CATEGORY->getSubCategoriesByCategory($_POST["id"]);

    echo json_encode($result);
    header('Content-type: application/json');
    exit();
}