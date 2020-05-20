<?php

include_once(dirname(__FILE__) . '/../../../class/include.php');
include_once(dirname(__FILE__) . '/../../auth.php');

if ($_POST['option'] == 'delete') {

    $ROOM_PHOTO = new RoomPhoto($_POST['id']);

    unlink('../../../upload/room/gallery/' . $ROOM_PHOTO->image_name);
    unlink('../../../upload/room/gallery/thumb/' . $ROOM_PHOTO->image_name);

    $result = $ROOM_PHOTO->delete();


    if ($result) {

        $data = array("status" => TRUE);
        header('Content-type: application/json');
        echo json_encode($data);
    }
}