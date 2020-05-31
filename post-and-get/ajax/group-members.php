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
        $GMSESSION = new GameSession($_SESSION['game_session']);

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
                $arr['id'] = $member['member'];
                $arr['session'] = $_SESSION['game_session'];
                $arr['is_online'] = $member['is_online'];
                $arr['current_player'] = $GMSESSION->current_player;
                $arr['sort'] = $member['sort'];
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

if ($_POST['action'] == 'UPDATECURRENTMEMBER') {
    session_start();
    if ($_SESSION['game_session']) {
        $GMSESSION = new GameSession($_SESSION['game_session']);
        $count = count(GameSessionMembers::getMembersByGameSession($_SESSION['game_session']));
        $curr_player = $GMSESSION->current_player;
        
        if ($curr_player == $count) {
            $GMSESSION->current_player = 1;
        } else {

            $GMSESSION->current_player = $curr_player + 1;
        }
        $result = $GMSESSION->updateCurrentPlayer();

        if ($result) {
            $member = GameSessionMembers::getNextPlayer($_SESSION['game_session'], $GMSESSION->current_player);
            header('Content-type: application/json');
            $arr = array();
            $arr['sort'] = $member['sort'];
            $arr['count'] = $count;
            $arr['status'] = 'success';
            echo json_encode($arr);
            exit();
        }
    } else {
        $arr = array();
        $arr['status'] = 'success';
        header('Content-type: application/json');
        echo json_encode($arr);
        exit();
    }
}
?>