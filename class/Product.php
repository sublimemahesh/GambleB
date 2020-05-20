<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author W j K n``
 */
class Product {

    public $id;
    public $category;
    public $sub_category;
    public $brand;
    public $name;
    public $discount;
    public $unite;
    public $price;
    public $image_name;
    public $short_description;
    public $description;
    public $in_stock;
    public $min_qty;
    public $max_qty;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT * FROM `product` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->category = $result['category'];
            $this->sub_category = $result['sub_category'];
            $this->brand = $result['brand'];
            $this->name = $result['name'];
            $this->discount = $result['discount'];
            $this->unite = $result['unite'];
            $this->price = $result['price'];
            $this->image_name = $result['image_name'];
            $this->short_description = $result['short_description'];
            $this->description = $result['description'];
            $this->in_stock = $result['in_stock'];
            $this->min_qty = $result['min_qty'];
            $this->max_qty = $result['max_qty'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `product` (`category`,`sub_category`,`brand`,`name`,`discount`,`unite`,`price`,`image_name`,`short_description`,`description`,`in_stock`,`min_qty`,`max_qty`,`queue`) VALUES  ('"
                . $this->category . "','"
                . $this->sub_category . "','"
                . $this->brand . "','"
                . $this->name . "', '"
                . $this->discount . "', '"
                . $this->unite . "', '"
                . $this->price . "', '"
                . $this->image_name . "', '"
                . $this->short_description . "', '"
                . $this->description . "', '"
                . $this->in_stock . "', '"
                . $this->min_qty . "', '"
                . $this->max_qty . "', '"
                . $this->queue . "')";


        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `product` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `product` SET "
                . "`category` ='" . $this->category . "', "
                . "`sub_category` ='" . $this->sub_category . "', "
                . "`brand` ='" . $this->brand . "', "
                . "`name` ='" . $this->name . "', "
                . "`discount` ='" . $this->discount . "', "
                . "`unite` ='" . $this->unite . "', "
                . "`price` ='" . $this->price . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`short_description` ='" . $this->short_description . "', "
                . "`description` ='" . $this->description . "', "
                . "`in_stock` ='" . $this->in_stock . "', "
                . "`min_qty` ='" . $this->min_qty . "', "
                . "`max_qty` ='" . $this->max_qty . "', "
                . "`queue` ='" . $this->queue . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {


        $query = 'DELETE FROM `product` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function getProductsBySubProduct($sub_category) {


        $query = 'SELECT * FROM `product` WHERE sub_category="' . $sub_category . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsByBrand($brand) {


        $query = 'SELECT * FROM `product` WHERE `brand`="' . $brand . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getBrandByCategory($category) {

        $query = 'SELECT DISTINCT `brand`  FROM `product` WHERE `category`="' . $category . '"';

        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsBySubCategory($subcategory) {

        $query = 'SELECT * FROM `product` WHERE sub_category="' . $subcategory . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsByCategory($category) {

        $query = 'SELECT * FROM `product` WHERE category="' . $category . '"   ORDER BY queue ASC';

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function getProductsBySubCategories($category, $minimum_price, $maximum_price, $sub_category, $brand, $page, $per_page) {

        if (isset($category)) {

            $query = 'SELECT * FROM `product` WHERE category="' . $category . '"';

            if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($minimum_price)) {
                $query .= 'AND `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
            }

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }

//            $query .= ' ORDER BY  queue DESC LIMIT ' . $page . ',' . $per_page . '';
        }


        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 30) {
                $name = substr($row['name'], 0, 26) . '...';
            } else {
                $name = $row['name'];
            }

            $out_put .= '<ul class="product-grid col-md-4 col-sm-6">';
            $out_put .= '<li class="col-md-12 col-sm-12">
                                        <div class="product-box common-cart-box">
                                            <div class="product-img common-cart-img">
                                                <img src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" alt="product-img">
                                                <input type="hidden" id="discount' . $row['id'] . '" value="' . $row['discount'] . '"/>
                                                <input type="hidden" id="price' . $row['id'] . '" value="' . $row['price'] . '"/>
                                                <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                                                <input   type="hidden" name="name"  id="quantity' . $row['id'] . '" value="1" />
                                                <div class="hover-option">
                                                    
                                                    <ul class="hover-icon">
                                                        <li><a href="view-product.php?id=' . $row['id'] . '"><i class="fa fa-link"></i></a></li>
                                                        <li><a data-target="#view-pro-popup-' . $row['id'] . '" data-toggle="modal" href="#" class="quickview-popup-link quickview-popup-link1"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info common-cart-info text-center">
                                                <a href="view-product.php?id=' . $row['id'] . '" class="cart-name">
                                                    ' . $name . '
                                                </a>
                                                <p class="cart-price">';

            if (!empty($row['discount'])) {

                $out_put .= '<del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2);
            } else {
                $out_put .= 'Rs: ' . number_format($row['price'], 2);
            }


            $out_put .= '</p>
                                            </div>
                                        </div>
                                        </li>



<div class="modal fade" id="view-pro-popup-' . $row['id'] . '"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-image">
                                                    <img class="product_img" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" data-zoom-image="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"/>
                                                </div>
                                </div>
                                <div class="col-md-7"> 
                                    <div class="quickview-product-detail">
                                                    <h2 class="box-title">' . $row['name'] . '</h2>';
            if (!empty($row['discount'])) {

                $out_put .= '<h3 class = "box-price"><del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2) . '</h3>';
            } else {
                $out_put .= '<h3 class = "box-price">Rs: ' . number_format($row['price'], 2) . '</h3>';
            }
            $out_put .= '<span class="box-text">' . $row['short_description'] . '</span>
                                                    <p class=""><b>Brand</b>: <span>' . $BRAND->name . '</span></p>
                                                    <p class=""><b>Unit</b>: <span>' . $row['unite'] . '</span></p>
                                                    <p class=""><b>Order Limit</b>: <span>Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . '</span></p>
                                                    <p class="stock">Availability: <span>';

            if ($row['in_stock'] == 1) {

                $out_put .= '<span>In Stock</span>';
            } else {

                $out_put .= '<span>Not In Stock</span>';
            }

            $out_put .= '</span>
                                                        </p>
                                                    <div class="quantity-box">
                                                        <p>Quantity:</p>
                                                        <div class="input-group">
                                                            <input type="button" value="-" class="minus" pro="' . $row['id'] . '" pro="' . $row['id'] . '">
                                                            <input class="quantity-number qty" id="quantity1' . $row['id'] . '" type="text" value="1" min="1" max="10" readonly="" >
                                                            <input type="button" value="+" class="plus"  pro="' . $row['id'] . '">
                                                        </div>

                                                        <div class="quickview-cart-btn">';

            if ($row['in_stock'] == 1) {

                $out_put .= '<div  class="btn btn-primary add_to_cart" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</div>';
            } else {

                $out_put .= '<div class="btn btn-danger" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Not in Stock</div>';
            }

            $out_put .= '</div>
                                                    </div>
                                                </div>
                                </div>  
                             </div>  
                        </div>
                    </div>
                </div>
            </div>



                                    
                                    </ul>';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getAllProducts($minimum_price, $maximum_price, $pageLimit, $setLimit) {
//    public function getAllProducts($minimum_price, $maximum_price) {


        $query = 'SELECT * FROM `product` ';

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {
            $query .= 'WHERE `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '" ';
        }

        $query .= "ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit;

        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 30) {
                $name = substr($row['name'], 0, 26) . '...';
            } else {
                $name = $row['name'];
            }

            $out_put .= '<ul class="product-grid col-md-4 col-sm-6">';
            $out_put .= '<li class="col-md-12 col-sm-12">
                                        <div class="product-box common-cart-box">
                                            <div class="product-img common-cart-img">
                                                <img src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" alt="product-img">
                                                <input type="hidden" id="discount' . $row['id'] . '" value="' . $row['discount'] . '"/>
                                                <input type="hidden" id="price' . $row['id'] . '" value="' . $row['price'] . '"/>
                                                <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                                                <input   type="hidden" name="name"  id="quantity' . $row['id'] . '" value="1" />
                                                <div class="hover-option">
                                                    
                                                    <ul class="hover-icon">
                                                        <li><a href="view-product.php?id=' . $row['id'] . '"><i class="fa fa-link"></i></a></li>
                                                        <li><a data-target="#view-pro-popup-' . $row['id'] . '" data-toggle="modal" href="#" class="quickview-popup-link quickview-popup-link1"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info common-cart-info text-center">
                                                <a href="view-product.php?id=' . $row['id'] . '" class="cart-name">
                                                    ' . $name . '
                                                </a>
                                                <p class="cart-price">';

            if (!empty($row['discount'])) {

                $out_put .= '<del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2);
            } else {
                $out_put .= 'Rs: ' . number_format($row['price'], 2);
            }


            $out_put .= '</p>
                                            </div>
                                        </div>
                                        </li>



<div class="modal fade" id="view-pro-popup-' . $row['id'] . '"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-image">
                                                    <img class="product_img" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" data-zoom-image="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"/>
                                                </div>
                                </div>
                                <div class="col-md-7"> 
                                    <div class="quickview-product-detail">
                                                    <h2 class="box-title">' . $row['name'] . '</h2>';
            if (!empty($row['discount'])) {

                $out_put .= '<h3 class = "box-price"><del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2) . '</h3>';
            } else {
                $out_put .= '<h3 class = "box-price">Rs: ' . number_format($row['price'], 2) . '</h3>';
            }
            $out_put .= '<span class="box-text">' . $row['short_description'] . '</span>
                                                    <p class=""><b>Brand</b>: <span>' . $BRAND->name . '</span></p>
                                                    <p class=""><b>Unit</b>: <span>' . $row['unite'] . '</span></p>
                                                    <p class=""><b>Order Limit</b>: <span>Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . '</span></p>
                                                    <p class="stock">Availability: <span>';

            if ($row['in_stock'] == 1) {

                $out_put .= '<span>In Stock</span>';
            } else {

                $out_put .= '<span>Not In Stock</span>';
            }

            $out_put .= '</span>
                                                        </p>
                                                    <div class="quantity-box">
                                                        <p>Quantity:</p>
                                                        <div class="input-group">
                                                            <input type="button" value="-" class="minus" pro="' . $row['id'] . '">
                                                            <input class="quantity-number qty" id="quantity1' . $row['id'] . '" type="text" value="1" min="1" max="10" readonly="">
                                                            <input type="button" value="+" class="plus"  pro="' . $row['id'] . '">
                                                        </div>

                                                        <div class="quickview-cart-btn">';

            if ($row['in_stock'] == 1) {

                $out_put .= '<div  class="btn btn-primary add_to_cart" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</div>';
            } else {

                $out_put .= '<div class="btn btn-danger" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Not in Stock</div>';
            }

            $out_put .= '</div>
                                                    </div>
                                                    
                                                </div>
                                </div>  
                             </div>  
                        </div>
                    </div>
                </div>
            </div>



                                    
                                    </ul>';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getProductsByBrands($brand_id, $brand, $minimum_price, $maximum_price) {

        if (isset($brand_id)) {

            $query = 'SELECT * FROM `product` WHERE `brand`="' . $brand_id . '"';

            if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($minimum_price)) {
                $query .= 'AND `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
            }


            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'OR `brand` in(' . $brand_filter . ')';
            }

//            $query .= ' ORDER BY  queue DESC LIMIT ' . $page . ',' . $per_page . '';
        }


        $db = new Database();
        $result = $db->readQuery($query);

        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 30) {
                $name = substr($row['name'], 0, 26) . '...';
            } else {
                $name = $row['name'];
            }

            $out_put .= '<ul class="product-grid col-md-4 col-sm-6">';
            $out_put .= '<li class="col-md-12 col-sm-12">
                                        <div class="product-box common-cart-box">
                                            <div class="product-img common-cart-img">
                                                <img src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" alt="product-img">
                                                <input type="hidden" id="discount' . $row['id'] . '" value="' . $row['discount'] . '"/>
                                                <input type="hidden" id="price' . $row['id'] . '" value="' . $row['price'] . '"/>
                                                <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                                                <input   type="hidden" name="name"  id="quantity' . $row['id'] . '" value="1" />
                                                <div class="hover-option">
                                                    
                                                    <ul class="hover-icon">
                                                        <li><a href="view-product.php?id=' . $row['id'] . '"><i class="fa fa-link"></i></a></li>
                                                        <li><a data-target="#view-pro-popup-' . $row['id'] . '" data-toggle="modal" href="#" class="quickview-popup-link quickview-popup-link1"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info common-cart-info text-center">
                                                <a href="view-product.php?id=' . $row['id'] . '" class="cart-name">
                                                    ' . $name . '
                                                </a>
                                                <p class="cart-price">';

            if (!empty($row['discount'])) {

                $out_put .= '<del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2);
            } else {
                $out_put .= 'Rs: ' . number_format($row['price'], 2);
            }


            $out_put .= '</p>
                                            </div>
                                        </div>
                                        </li>



<div class="modal fade" id="view-pro-popup-' . $row['id'] . '"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-image">
                                                    <img class="product_img" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" data-zoom-image="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"/>
                                                </div>
                                </div>
                                <div class="col-md-7"> 
                                    <div class="quickview-product-detail">
                                                    <h2 class="box-title">' . $row['name'] . '</h2>';
            if (!empty($row['discount'])) {

                $out_put .= '<h3 class = "box-price"><del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2) . '</h3>';
            } else {
                $out_put .= '<h3 class = "box-price">Rs: ' . number_format($row['price'], 2) . '</h3>';
            }
            $out_put .= '<span class="box-text">' . $row['short_description'] . '</span>
                                                    <p class=""><b>Brand</b>: <span>' . $BRAND->name . '</span></p>
                                                    <p class=""><b>Unit</b>: <span>' . $row['unite'] . '</span></p>
                                                    <p class=""><b>Order Limit</b>: <span>Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . '</span></p>
                                                    <p class="stock">Availability: <span>';

            if ($row['in_stock'] == 1) {

                $out_put .= '<span>In Stock</span>';
            } else {

                $out_put .= '<span>Not In Stock</span>';
            }

            $out_put .= '</span>
                                                        </p>
                                                    <div class="quantity-box">
                                                        <p>Quantity:</p>
                                                        <div class="input-group">
                                                            <input type="button" value="-" class="minus" pro="' . $row['id'] . '">
                                                            <input class="quantity-number qty" id="quantity1' . $row['id'] . '" type="text" value="1" min="1" max="10" readonly="">
                                                            <input type="button" value="+" class="plus"  pro="' . $row['id'] . '">
                                                        </div>

                                                        <div class="quickview-cart-btn">';

            if ($row['in_stock'] == 1) {

                $out_put .= '<div  class="btn btn-primary add_to_cart" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</div>';
            } else {

                $out_put .= '<div class="btn btn-danger" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Not in Stock</div>';
            }

            $out_put .= '</div>
                                                    </div>
                                                    
                                                </div>
                                </div>  
                             </div>  
                        </div>
                    </div>
                </div>
            </div>



                                    
                                    </ul>';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getMaxPriceInProduct($category, $sub_category, $brand) {

        if (isset($category)) {

            $query = 'SELECT max(price) FROM `product` WHERE category = "' . $category . '"';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        };
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function getMinPriceInProduct($category, $sub_category, $brand) {

        if (isset($category)) {

            $query = 'SELECT min(price) FROM `product` WHERE category = "' . $category . '"';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        };
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

//    public function getProductsByCategoryByAll($category, $pageLimit, $setLimit) {
//
//        $query = "SELECT * FROM `product` where `category` = " . $category . "   ORDER BY queue DESC LIMIT " . $pageLimit . " , " . $setLimit . "  ";
//
//        $db = new Database();
//
//        $result = $db->readQuery($query);
//        $array_res = array();
//
//        while ($row = mysql_fetch_array($result)) {
//            array_push($array_res, $row);
//        }
//        return $array_res;
//    }

    public function arrange($key, $img) {

        $query = "UPDATE `product` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

    public function showPagination11111($id, $sub_category, $brand, $per_page, $page) {

        $page_url = "?";
        if (isset($id)) {
            $query = 'SELECT COUNT(*) as totalCount FROM `product` WHERE category = "' . $id . '" ';

            if (!empty($sub_category)) {
                $sub_category_filter = implode(",", $sub_category);
                $query .= 'AND `sub_category` in(' . $sub_category_filter . ')';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        }

        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        $total = $row['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {

            $setPaginate .= "<div class='product-pagi-nav pull-right'>";
            $setPaginate .= "<a>Page $page of $setLastpage</a> ";

            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page) {
                        $setPaginate .= " <a class='current_page'>$counter</a> ";
                    } else {
                        $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }
                }
            } elseif ($setLastpage > 5 + ($adjacents * 2)) {

                if ($page <= 1 + ((int) $adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ((int) $adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= " <a class='current_page'>$counter</a> ";
                        else
                            $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }

                    $setPaginate .= "<a href='{$page_url}page= $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $setPaginate .= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate .= "<a class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&id=$id'>$counter</a>";
                    }
                    $setPaginate .= "< class='dot'>..";
                    $setPaginate .= "<a href='{$page_url}page = $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                else {
                    $setPaginate .= "<a href='{$page_url}page = 1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page = 2'>2</a>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&i =$id'>$counter</a>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<a href='{$page_url}page=$next&id=$id'>Next</a>";
                $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>Last</a>";
            } else {
                $setPaginate .= "<a class='current_page'>Next</a>";
                $setPaginate .= "<a class='current_page'>Last</a>";
            }

            $setPaginate .= "</div>\n";
        }
        echo $setPaginate;
    }

    public function showPagination($minimum_price, $maximum_price, $category, $cat, $sub_category, $brand, $per_page, $page) {
        $w = array();
        $where = '';

        if (!empty($category)) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }

            $w[] = '`category` IN (' . $cat_list . ')';
        }

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {
            $w[] = '`price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
        }

        if (!empty($sub_category)) {
            $w[] = '`sub_category` = "' . $sub_category . '"';
        }
        if (!empty($cat)) {
            $w[] = '`category` = "' . $cat . '"';
        }

        if (!empty($brand)) {
            $brand_filter = implode(",", $brand);
            $w[] = '`brand` in(' . $brand_filter . ')';
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $db = new Database();

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `product`  $where  ORDER BY `queue` asc";

        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate.= "<li><a href='#' class='page' page='1'>1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$lpm1'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate.= "<li><a href='#' class='page' page='1>1</a></li>";
                    $setPaginate.= "<li><a href='#' class='page' page='2'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='#' class='page' page='$counter'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate.= "<li><a href='#' class='page' page='$next'>Next</a></li>";
                $setPaginate.= "<li><a href='#' class='page' page='$setLastpage'>Last</a></li>";
            } else {
                $setPaginate.= "<li><a class='current_page page'>Next</a></li>";
                $setPaginate.= "<li><a class='current_page page'>Last</a></li>";
            }

            $setPaginate.= "</ul>\n";
        }

        echo $setPaginate;
    }

    public function showPagination1($id, $sub_category, $brand, $per_page, $page) {

        $page_url = "?";
        $query = 'SELECT COUNT(*) as totalCount FROM `product`';

        if (isset($minimum_price) && isset($maximum_price) && !empty($minimum_price) && !empty($maximum_price)) {
            $query .= 'WHERE `price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '" ';
        }


        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        $total = $row['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {

            $setPaginate .= "<div class='product-pagi-nav pull-right'>";
            $setPaginate .= "<a>Page $page of $setLastpage</a> ";

            if ($setLastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page) {
                        $setPaginate .= " <a class='current_page'>$counter</a> ";
                    } else {
                        $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }
                }
            } elseif ($setLastpage > 5 + ($adjacents * 2)) {

                if ($page <= 1 + ((int) $adjacents * 2)) {

                    for ($counter = 1; $counter < 4 + ((int) $adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate .= " <a class='current_page'>$counter</a> ";
                        else
                            $setPaginate .= " <a href='{$page_url}page=$counter&id=$id'>$counter</a> ";
                    }

                    $setPaginate .= "<a href='{$page_url}page= $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                    $setPaginate .= "<a href='{$page_url}page=1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page=2'>2</a>";
                    $setPaginate .= "<a class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&id=$id'>$counter</a>";
                    }
                    $setPaginate .= "< class='dot'>..";
                    $setPaginate .= "<a href='{$page_url}page = $lpm1'>$lpm1</a>";
                    $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>$setLastpage</a>";
                }
                else {
                    $setPaginate .= "<a href='{$page_url}page = 1'>1</a>";
                    $setPaginate .= "<a href='{$page_url}page = 2'>2</a>";
                    $setPaginate .= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate .= "<a class='current_page'>$counter</a>";
                        else
                            $setPaginate .= "<a href='{$page_url}page=$counter&i =$id'>$counter</a>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate .= "<a href='{$page_url}page=$next&id=$id'>Next</a>";
                $setPaginate .= "<a href='{$page_url}page=$setLastpage&id=$id'>Last</a>";
            } else {
                $setPaginate .= "<a class='current_page'>Next</a>";
                $setPaginate .= "<a class='current_page'>Last</a>";
            }

            $setPaginate .= "</div>\n";
        }
        echo $setPaginate;
    }

    public function getAllProductsByCategoryAndBrand($category, $cat, $minimum_price, $maximum_price, $sub_category, $brand, $pageLimit, $setLimit) {


        $w = array();
        $where = '';

        if (!empty($category)) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }

            $w[] = '`category` IN (' . $cat_list . ')';
        }

        if (isset($minimum_price) && isset($maximum_price) && $minimum_price != '' && $maximum_price != '') {

            $w[] = '`price` BETWEEN "' . $minimum_price . '" AND "' . $maximum_price . '"';
        }

        if (!empty($sub_category)) {
            $w[] = '`sub_category` = "' . $sub_category . '"';
        }
        if (!empty($cat)) {
            $w[] = '`category` = "' . $cat . '"';
        }

        if (!empty($brand)) {
            $brand_filter = implode(",", $brand);
            $w[] = '`brand` in(' . $brand_filter . ')';
        }

        if (count($w)) {
            $where = " WHERE " . implode(' AND ', $w);
        }
        $query = "SELECT * FROM `product` $where";

        $query .= " ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit;

        $db = new Database();
        $result = $db->readQuery($query);


        $out_put = '';
        while ($row = mysql_fetch_array($result)) {
            $BRAND = new Brand($row['brand']);

            $price_amount = 0;
            $discount = 0;

            $discount = $row['discount'];
            $price_amount = $row['price'];

            $discount = ($price_amount * $discount) / 100;
            $discount_price = $row['price'] - $discount;

            if (strlen($row['name']) > 30) {
                $name = substr($row['name'], 0, 26) . '...';
            } else {
                $name = $row['name'];
            }

            $out_put .= '<ul class="product-grid col-md-4 col-sm-6">';
            $out_put .= '<li class="col-md-12 col-sm-12">
                                        <div class="product-box common-cart-box">
                                            <div class="product-img common-cart-img">
                                                <img src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" alt="product-img">
                                                <input type="hidden" id="discount' . $row['id'] . '" value="' . $row['discount'] . '"/>
                                                <input type="hidden" id="price' . $row['id'] . '" value="' . $row['price'] . '"/>
                                                <input   type="hidden" name="name"  id="name' . $row['id'] . '" value="' . $row['name'] . '" />
                                                <input   type="hidden" name="name"  id="quantity' . $row['id'] . '" value="1" />
                                                <div class="hover-option">
                                                    
                                                    <ul class="hover-icon">
                                                        <li><a href="view-product.php?id=' . $row['id'] . '"><i class="fa fa-link"></i></a></li>
                                                        <li><a data-target="#view-pro-popup-' . $row['id'] . '" data-toggle="modal" href="#" class="quickview-popup-link quickview-popup-link1"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-info common-cart-info text-center">
                                                <a href="view-product.php?id=' . $row['id'] . '" class="cart-name">
                                                    ' . $name . '
                                                </a>
                                                <p class="cart-price">';

            if (!empty($row['discount'])) {

                $out_put .= '<del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2);
            } else {
                $out_put .= 'Rs: ' . number_format($row['price'], 2);
            }


            $out_put .= '</p>
                                            </div>
                                        </div>
                                        </li>



<div class="modal fade" id="view-pro-popup-' . $row['id'] . '"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document"> 
                    <div class="modal-content">
                        
                        <div class="modal-body mx-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="product-image">
                                                    <img class="product_img" src="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '" data-zoom-image="upload/product-categories/sub-category/product/photos/' . $row['image_name'] . '"/>
                                                </div>
                                </div>
                                <div class="col-md-7"> 
                                    <div class="quickview-product-detail">
                                                    <h2 class="box-title">' . $row['name'] . '</h2>';
            if (!empty($row['discount'])) {

                $out_put .= '<h3 class = "box-price"><del>Rs: ' . number_format($row['price'], 2) . '</del>';

                $price = $row['price'] - (($row['price'] * $row['discount']) / 100);
                $out_put .= 'Rs: ' . number_format($price, 2) . '</h3>';
            } else {
                $out_put .= '<h3 class = "box-price">Rs: ' . number_format($row['price'], 2) . '</h3>';
            }
            $out_put .= '<span class="box-text">' . $row['short_description'] . '</span>
                                                    <p class=""><b>Brand</b>: <span>' . $BRAND->name . '</span></p>
                                                    <p class=""><b>Unit</b>: <span>' . $row['unite'] . '</span></p>
                                                    <p class=""><b>Order Limit</b>: <span>Minimum ' . $row['min_qty'] . ' & Maximum ' . $row['max_qty'] . '</span></p>
                                                    <p class="stock">Availability: <span>';

            if ($row['in_stock'] == 1) {

                $out_put .= '<span>In Stock</span>';
            } else {

                $out_put .= '<span>Not In Stock</span>';
            }

            $out_put .= '</span>
                                                        </p>
                                                    <div class="quantity-box">
                                                        <p>Quantity:</p>
                                                        <div class="input-group">
                                                            <input type="button" value="-" class="minus" pro="' . $row['id'] . '">
                                                            <input class="quantity-number qty" id="quantity1' . $row['id'] . '" type="text" value="1" min="1" max="10" readonly="">
                                                            <input type="button" value="+" class="plus"  pro="' . $row['id'] . '">
                                                        </div>

                                                        <div class="quickview-cart-btn">';

            if ($row['in_stock'] == 1) {

                $out_put .= '<div  class="btn btn-primary add_to_cart" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '" max-qty="' . $row['max_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Add To Cart</div>';
            } else {

                $out_put .= '<div class="btn btn-danger" id="' . $row['id'] . '"  min-qty="' . $row['min_qty'] . '"><img src="image/cart-icon-1.png" alt="cart-icon-1"> Not in Stock</div>';
            }

            $out_put .= '</div>
                                                    </div>
                                                    
                                                </div>
                                </div>  
                             </div>  
                        </div>
                    </div>
                </div>
            </div>



                                    
                                    </ul>';
        }

        if (!empty($out_put)) {
            echo $out_put;
        } else {
            echo $out_put = 'No Data Found..!';
        }
    }

    public function getMaxPriceInProduct1($category, $cat, $sub_category, $brand) {
        if ((isset($category) && !empty($category)) || (isset($cat) && !empty($cat))) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }

            $query = 'SELECT max(price) FROM `product` WHERE `category` IN (' . $cat_list . ')';

            if (!empty($sub_category)) {
                $query .= 'AND `sub_category` = "' . $sub_category . '"';
            }
            if (!empty($cat)) {
                $query .= ' AND `category` = "' . $cat . '"';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        } else {
            $query = 'SELECT max(price) FROM `product`';
        }
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function getMinPriceInProduct1($category, $cat, $sub_category, $brand) {

        if ((isset($category) && !empty($category)) || (isset($cat) && !empty($cat))) {
            $cat_list = '';
            foreach ($category as $cat) {
                if (empty($cat_list)) {
                    $cat_list .= $cat;
                } else {
                    $cat_list .= ',' . $cat;
                }
            }
            $query = 'SELECT min(price) FROM `product` WHERE category IN (' . $cat_list . ')';

            if (!empty($sub_category)) {
                $query .= 'AND `sub_category` = "' . $sub_category . '"';
            }
            if (!empty($cat)) {
                $query .= ' AND `category` = "' . $cat . '"';
            }

            if (!empty($brand)) {
                $brand_filter = implode(",", $brand);
                $query .= 'AND `brand` in(' . $brand_filter . ')';
            }
        } else {
            $query = 'SELECT min(price) FROM `product`';
        }
        $db = new Database();

        $result = $db->readQuery($query);
        $row = mysql_fetch_array($result);

        return $row;
    }

    public function search($category, $keyword, $pageLimit, $setLimit) {

        $w = array();
        $where = '';


        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "' ";
        }
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%' ";
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $query = "SELECT * FROM `product` $where ORDER BY `queue` ASC LIMIT " . $pageLimit . " , " . $setLimit . "";


        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function showPaginationForSearch($category, $keyword, $per_page, $page) {
        $w = array();
        $where = '';

        if (!empty($category)) {
            $w[] = "`category` = '" . $category . "' ";
        }
        if (!empty($keyword)) {
            $w[] = "`name` LIKE '%" . $keyword . "%' ";
        }

        if (count($w)) {
            $where = "WHERE " . implode(' AND ', $w);
        }

        $page_url = "?";
        $query = "SELECT COUNT(*) as totalCount FROM `product`  $where  ORDER BY `queue` asc";
        $rec = mysql_fetch_array(mysql_query($query));

        $total = $rec['totalCount'];

        $adjacents = "2";

        $page = ($page == 0 ? 1 : $page);
        $start = ($page - 1) * $per_page;

        $prev = $page - 1;
        $next = $page + 1;

        $setLastpage = ceil($total / $per_page);

        $lpm1 = $setLastpage - 1;
        $setPaginate = "";
        if ($setLastpage > 1) {
            $setPaginate .= "<ul class='setPaginate'>";
            $setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
            if ($setLastpage < 7 + ($adjacents * 2)) {

                for ($counter = 1; $counter <= $setLastpage; $counter++) {

                    if ($counter == $page)
                        $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                    else
                        $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                }
            }
            elseif ($setLastpage > 5 + ($adjacents * 2)) {
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>...</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1&category=$category&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>$setLastpage</a></li>";
                }
                elseif ($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $setPaginate.= "<li><a href='{$page_url}page=1&category=$category&keyword=$keyword'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2&category=$category&keyword=$keyword'>2</a></li>";
                    $setPaginate.= "<li class='dot'>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                    $setPaginate.= "<li class='dot'>..</li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$lpm1&category=$category&keyword=$keyword'>$lpm1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>$setLastpage</a></li>";
                }
                else {
                    $setPaginate.= "<li><a href='{$page_url}page=1&category=$category&keyword=$keyword'>1</a></li>";
                    $setPaginate.= "<li><a href='{$page_url}page=2&category=$category&keyword=$keyword'>2</a></li>";
                    $setPaginate.= "<li class='dot'>..</li>";
                    for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++) {
                        if ($counter == $page)
                            $setPaginate.= "<li><a class='current_page'>$counter</a></li>";
                        else
                            $setPaginate.= "<li><a href='{$page_url}page=$counter&category=$category&keyword=$keyword'>$counter</a></li>";
                    }
                }
            }

            if ($page < $counter - 1) {
                $setPaginate.= "<li><a href='{$page_url}page=$next&category=$category&keyword=$keyword'>Next</a></li>";
                $setPaginate.= "<li><a href='{$page_url}page=$setLastpage&category=$category&keyword=$keyword'>Last</a></li>";
            } else {
                $setPaginate.= "<li><a class='current_page'>Next</a></li>";
                $setPaginate.= "<li><a class='current_page'>Last</a></li>";
            }

            $setPaginate.= "</ul>\n";
        }

        echo $setPaginate;
    }

}
