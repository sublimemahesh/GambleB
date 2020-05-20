<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $TOUR_DATE_PHOTO = new TourDatePhoto($_POST['id']);

    unlink('../../../upload/tour-package/date/gallery/' . $TOUR_DATE_PHOTO ->image_name);
    unlink('../../../upload/tour-package/date/gallery/thumb/' . $TOUR_DATE_PHOTO ->image_name);

    $result = $TOUR_DATE_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}