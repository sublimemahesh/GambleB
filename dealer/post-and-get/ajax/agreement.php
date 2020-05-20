<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . './auth.php');


if ($_POST['action'] == 'send_agreement') {

    $DEALER = new Dealer($_POST['id']);

    $to = $DEALER->email;
    $subject = 'Agreement - CASHONDELIVERY.LK';
    $from = 'CASHONDELIVERY.LK <info@cashondelivery.lk>';

// To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
    $message = '<html>';
    $message .= '<body>';
    $message .= '<h2>Dealer Agreement - CASHONDELIVERY.LK</h2>';
    $message .= '<p>I ' . $DEALER->name . ', holding NIC - ' . $DEALER->nic . ' hereby accept the fact that I am logged in as one of the vendor to the website www.cashondelivery.lk , and I take the full responsibility over the orders accepted by me, including the pricing, and the quality of the products, and I do fully understand www.cashondelivery.lk is only a web portal that facilitate us to get online orders and to get connected with customers.</p>';
    $message .= '<p>www.cashondelivery.lk will have no legal liability towards the customer in any case with regards of pricing published on the website instead the prices for the products are being published and accepted by me as a vender and www.cashondelivery.lk will not be liable for any undelivered order or missing item or damaged or expired items, instead I will be liable as the vender handling the order, which I personally accepted from the online web portal www.cashondelivery.lk.</p>';
    $message .= '<p>I Accept the fact that www.cashondelivery.lk has advised me on pricing (not to over price) any item on the website, or not to overcharge above the maximum retail price stated on any product, in such case if the customer will be overcharged on delivery, I will responsible for the charges.</p>';
    $message .= '<p>I agree to pay a commission worth 300.00LKR from each order I deliver, to the selected areas on my dealer account (selected by me) and this will be from the ,650 LKR total delivery charge that I will charge from the customer per delivery, thus 350 LKR for me and 300 LKR for the www.cashondelivery.lk and delivery charge will not be increased under any circumstances for the areas selected by me on creating the account with www.cashondelivery.lk And I am fully aware that this contract can be terminated by www.cashondelivery.lk at any given time, without further notice, if I will violate the agreement any time.</p>';
    $message .= '<ul>';
    $message .= '<li>Business Name: ' . $DEALER->business_name . '</li>';
    $message .= '<li>BR Number: ' . $DEALER->br_number . '</li>';
    $CITY = new City($DEALER->city);
    $message .= '<li>Address:  ' . $DEALER->address . ' - ' . $CITY->name . '</li>';
    $message .= '<li>Phone:  ' . $DEALER->phone . '</li>';
    $message .= '<li>Email:  ' . $DEALER->email . '</li>';
    $message .= '</ul>';
    $message .= '<br/>';
    $message .= '<br/>';
    $message .= '<br/>';
    $message .= '<br/>';
    $message .= '<small>.......................................................................</small>';
    $message .= '<br/>';
    $message .= '<span>Signature with Rubber Stamp<span>';
    $message .= '</body>';
    $message .= '</html>';

// Sending email
    if (mail($to, $subject, $message, $headers)) {

        $DEALER->agreement = 1;
        $DEALER->update();
        header('Content-type: application/json');
        $data = array("status" => "success");
        echo json_encode($data);
    } else {

        header('Content-type: application/json');
        $data = array("status" => "fail");
        echo json_encode($data);
    }
}

