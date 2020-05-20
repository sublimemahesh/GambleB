<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $TOUR_PACKAGE_PHOTO = new TourPackagePhotosNormal($_POST['id']);

    unlink('../../../upload/tour-package/gallery/' . $TOUR_PACKAGE_PHOTO->image_name);
    unlink('../../../upload/tour-package/gallery/thumb/' . $TOUR_PACKAGE_PHOTO->image_name);

    $result = $TOUR_PACKAGE_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}