<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$DEALER = new Dealer($_POST['id']);

$DEALER->name = $_POST['name'];
$DEALER->phone = $_POST['phone'];
$DEALER->email = $_POST['email'];
$DEALER->district = $_POST['district'];
$DEALER->city = $_POST['city'];
$DEALER->address = $_POST['address'];
$DEALER->nic = $_POST['nic'];
$DEALER->business_name = $_POST['business_name'];
$DEALER->br_number = $_POST['br_number'];

/////NIC PHOTO FRONT
$handle1 = new Upload($_FILES['nic_fr_photo']);
if ($handle1->uploaded) {
    $handle1->image_resize = true;
    $handle1->file_new_name_ext = 'jpg';
    $handle1->image_ratio_crop = 'C';

    if (empty($_POST['nic_fr_photo_ex'])) {
        $DEALER->nic_fr_photo = Helper::randamId();
    }

    $handle1->file_new_name_body = explode(".", $DEALER->nic_fr_photo)[0];
    $handle1->file_overwrite = TRUE;
    $image_dst_x = $handle1->image_dst_x;
    $image_dst_y = $handle1->image_dst_y;
    $newSize = Helper::calImgResize(600, $image_dst_x, $image_dst_y);
    $handle1->image_x = (int) $newSize[0];
    $handle1->image_y = (int) $newSize[1];
    $handle1->Process('../uploads/nic/');
    $DEALER->nic_fr_photo = $handle1->file_dst_name;
}

/////NIC PHOTO BACK
$handle2 = new Upload($_FILES['nic_bk_photo']);
if ($handle2->uploaded) {
    $handle2->image_resize = true;
    $handle2->file_new_name_ext = 'jpg';
    $handle2->image_ratio_crop = 'C';

    if (empty($_POST['nic_bk_photo_ex'])) {
        $DEALER->nic_bk_photo = Helper::randamId();
    }

    $handle2->file_new_name_body = explode(".", $DEALER->nic_bk_photo)[0];
    $handle2->file_overwrite = TRUE;
    $image_dst_x = $handle2->image_dst_x;
    $image_dst_y = $handle2->image_dst_y;
    $newSize = Helper::calImgResize(600, $image_dst_x, $image_dst_y);
    $handle2->image_x = (int) $newSize[0];
    $handle2->image_y = (int) $newSize[1];
    $handle2->Process('../uploads/nic/');
    $DEALER->nic_bk_photo = $handle2->file_dst_name;
}

/////BR COPY
$handle3 = new Upload($_FILES['br_copy']);
if ($handle3->uploaded) {
    $handle3->image_resize = true;
    $handle3->file_new_name_ext = 'jpg';
    $handle3->image_ratio_crop = 'C';

    if (empty($_POST['br_copy_ex'])) {
        $DEALER->br_copy = Helper::randamId();
    }

    $handle3->file_new_name_body = explode(".", $DEALER->br_copy)[0];
    $handle3->file_overwrite = TRUE;
    $image_dst_x = $handle3->image_dst_x;
    $image_dst_y = $handle3->image_dst_y;
    $newSize = Helper::calImgResize(600, $image_dst_x, $image_dst_y);
    $handle3->image_x = (int) $newSize[0];
    $handle3->image_y = (int) $newSize[1];
    $handle3->Process('../uploads/br/');
    $DEALER->br_copy = $handle3->file_dst_name;
}

$VALID = new Validator();
$VALID->check($DEALER, [
    'name' => ['required' => TRUE],
    'phone' => ['required' => TRUE],
    'email' => ['required' => TRUE],
    'district' => ['required' => TRUE],
    'city' => ['required' => TRUE],
    'address' => ['required' => TRUE],
    'nic' => ['required' => TRUE],
    'business_name' => ['required' => TRUE],
    'br_number' => ['required' => TRUE],
    'nic_fr_photo' => ['required' => TRUE],
    'nic_bk_photo' => ['required' => TRUE],
    'br_copy' => ['required' => TRUE],
]);

$checkEmail = $DEALER->checkEmail($_POST['id'], $_POST['email']);

if (!$checkEmail || $checkEmail['id'] == $_POST['id']) {
    if ($VALID->passed()) {
        $DEALER->update();

        $result = ["status" => 'success'];
        echo json_encode($result);
        exit();
    } else {

        $result = ["status" => 'error'];
        echo json_encode($result);
        exit();
    }
} else {
    $result = ["status" => 'error1'];
    echo json_encode($result);
    exit();
}
