<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['action'] == 'GETGROUPMEMBERS') {

    $groupmembers = GroupMember::getAllMembersByGroup($_POST['group']);

    if ($groupmembers) {
        $arr1 = array();
        $mem_arr = array();
        foreach ($groupmembers as $member) {
            $MEM = new Member($member['member']);

            $arr = array();

            if ($MEM->id == $_SESSION['id']) {
                $arr['name'] = 'You';
            } else {
                $arr['name'] = $MEM->name;
            }
            if ($member['is_online'] == 1) {
                $arr['is_online'] = 'active';
            } else {
                $arr['is_online'] = '';
            }
            $arr['profile_pic'] = $MEM->image_name;
            array_push($arr1, $arr);
        }
        $mem_arr['details'] = $arr1;
        $mem_arr['status'] = 'success';
    } else {
        $mem_arr = array();
        $mem_arr['status'] = 'error';
    }


    header('Content-type: application/json');
    echo json_encode($mem_arr);
    exit();
}

if ($_POST['action'] == 'GROUPSESSIONMEMBERS') {
    session_start();
    if ($_SESSION['game_session']) {
        $members = GameSessionMembers::getMembersByGameSession($_SESSION['game_session']);
        
        if ($members) {
        $arr1 = array();
        $mem_arr = array();
        foreach ($members as $member) {
            $MEM = new Member($member['member']);

            $arr = array();

            if ($MEM->id == $_SESSION['id']) {
                $arr['name'] = 'You';
            } else {
                $arr['name'] = $MEM->name;
            }
            if ($member['is_online'] == 1) {
                $arr['is_online'] = 'active';
            } else {
                $arr['is_online'] = '';
            }
            $arr['profile_pic'] = $MEM->image_name;
            array_push($arr1, $arr);
        }
        $mem_arr['details'] = $arr1;
        $mem_arr['status'] = 'success';
    } else {
        $mem_arr = array();
        $mem_arr['status'] = 'error';
    }

            header('Content-type: application/json');
            echo json_encode($mem_arr);
            exit();
        
    }
}
?>