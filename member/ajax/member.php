<?php

include_once(dirname(__FILE__) . '/../../class/include.php');


$MEMBER = new Member($_POST['id']);

$email = $MEMBER->email;
$MEMBER->name = $_POST['name'];
$MEMBER->phone_number = $_POST['phone'];
$MEMBER->email = $_POST['email'];
$MEMBER->country = $_POST['country'];
$MEMBER->address = $_POST['address'];

/////NIC PHOTO FRONT
$handle1 = new Upload($_FILES['profile_image']);
if ($handle1->uploaded) {
    $handle1->image_resize = true;
    $handle1->file_new_name_ext = 'jpg';
    $handle1->image_ratio_crop = 'C';

    if (empty($_POST['profile_image_ex'])) {
        $MEMBER->image_name = Helper::randamId();
    }

    $handle1->file_new_name_body = explode(".", $MEMBER->image_name)[0];
    $handle1->file_overwrite = TRUE;
    $handle->image_x = 250;
    $handle->image_y = 250;
    $handle1->Process('../../upload/member/profile_image/');
    $MEMBER->image_name = $handle1->file_dst_name;
}

$VALID = new Validator();
$VALID->check($MEMBER, [
    'name' => ['required' => TRUE],
    'phone_number' => ['required' => TRUE],
    'email' => ['required' => TRUE],
    'country' => ['required' => TRUE],
    'address' => ['required' => TRUE],
    'image_name' => ['required' => TRUE]
]);

$checkEmail = $MEMBER->checkEmail($_POST['id'], $_POST['email']);

if (!$checkEmail || $checkEmail['id'] == $_POST['id']) {
    if ($VALID->passed()) {
        $MEMBER->update();
        if ($email != $MEMBER->email) {
            $code = Helper::getVerifyCode();
            $MEMBER->updateVerifyCode($code);
            $MEMBER->sendVerificationMail($code);
        }
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
