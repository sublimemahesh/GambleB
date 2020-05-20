<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $TOUR_DATE = new TourDate($_POST['id']);

    unlink('../../../upload/tour-package/date/' . $TOUR_DATE ->image_name);
    unlink('../../../upload/tour-package/date/thumb/' . $TOUR_DATE ->image_name);

    $result = $TOUR_DATE->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}