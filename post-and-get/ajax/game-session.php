<?php

include_once(dirname(__FILE__) . '/../../class/include.php');

if ($_POST['action'] == 'STARTGAMESESSION') {

    $GSESSION = new GameSession(NULL);
    $GSESSION->group = $_POST['group'];
    $GSESSION->member = $_POST['member'];
    
    $result = $GSESSION->create();
    if ($result) {
        $groupmembers = GroupMember::getOnlineMembersByGroup($_POST['group']);
        foreach ($groupmembers as $key=>$member) {
            $SESSIONMEM = new GameSessionMembers(NULL);
            $SESSIONMEM->game_session = $result->id;
            $SESSIONMEM->member = $member['member'];
            $SESSIONMEM->is_online = 1;
            $SESSIONMEM->sort = $key+1;
            $res = $SESSIONMEM->create();
            
            session_start();
            $_SESSION['game_session'] = $result->id;
        }
        
    } 


    header('Content-type: application/json');
    echo json_encode($result);
    exit();
}
?>