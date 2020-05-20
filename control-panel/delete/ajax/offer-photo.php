<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $OFFER_PHOTO = new OfferPhoto($_POST['id']);

    unlink('../../../upload/offer/gallery/' . $OFFER_PHOTO->image_name);
    unlink('../../../upload/offer/gallery/thumb/' . $OFFER_PHOTO->image_name);

    $result = $OFFER_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}