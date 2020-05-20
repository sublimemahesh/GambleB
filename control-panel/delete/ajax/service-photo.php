<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $SERVICE_PHOTO = new ServicePhoto($_POST['id']);

    unlink('../../../upload/service/gallery/' . $SERVICE_PHOTO->image_name);
    unlink('../../../upload/service/gallery/thumb/' . $SERVICE_PHOTO->image_name);

    $result = $SERVICE_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}