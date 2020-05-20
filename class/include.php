<?php

error_reporting(E_ERROR | E_PARSE);

include_once(dirname(__FILE__) . '/Setting.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/Message.php');
include_once(dirname(__FILE__) . '/Validator.php');
include_once(dirname(__FILE__) . '/ProductCategories.php');
include_once(dirname(__FILE__) . '/Product.php');
include_once(dirname(__FILE__) . '/ProductPhoto.php');
include_once(dirname(__FILE__) . '/Brand.php');
include_once(dirname(__FILE__) . '/Country.php');
include_once(dirname(__FILE__) . '/City.php');
include_once(dirname(__FILE__) . '/Member.php');
include_once(dirname(__FILE__) . '/SubCategory.php');
include_once(dirname(__FILE__) . '/Offer.php');
include_once(dirname(__FILE__) . '/OfferPhoto.php');
include_once(dirname(__FILE__) . '/Comments.php');
include_once(dirname(__FILE__) . '/ProductReview.php');
include_once(dirname(__FILE__) . '/Package.php');
include_once(dirname(__FILE__) . '/AddToCart.php');
include_once(dirname(__FILE__) . '/Order.php');
include_once(dirname(__FILE__) . '/OrderProduct.php');
include_once(dirname(__FILE__) . '/Page.php');
include_once(dirname(__FILE__) . '/Game.php');

function dd($data) {

    var_dump($data);

    exit();
}

function redirect($url) {

    $string = '<script type="text/javascript">';

    $string .= 'window.location = "' . $url . '"';

    $string .= '</script>';



    echo $string;

    exit();
}
