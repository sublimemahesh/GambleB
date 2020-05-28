<?php

session_start();
if (Member::authenticate()) {
    $url = explode('/', $_SERVER['REQUEST_URI']);
//    $page = explode('?', $url[2]); //localhost
    $page = explode('?', $url[1]); //online
    if ($page[0] == 'view-group.php') {
        $groupmemid = GroupMember::checkMemberJoinedOrNot($_GET['id'], $_SESSION['id']);

        $GROUPMEM = new GroupMember($groupmemid);
        $GROUPMEM->is_online = 1;
        $GROUPMEM->updateOnlineStatus();
        if (isset($_SESSION['game_session'])) {
            GameSessionMembers::updateOnlineStatus($_SESSION['id'], $_SESSION['game_session']);
        }
    } elseif ($page[0] == 'play-game.php') {
        $groupmemid = GroupMember::checkMemberJoinedOrNot($_GET['id'], $_SESSION['id']);

        $GROUPMEM = new GroupMember($groupmemid);
        $GROUPMEM->is_online = 1;
        $GROUPMEM->updateOnlineStatus();
    } else {
        $joined_groups = GroupMember::getGroupsByMember($_SESSION['id']);

        foreach ($joined_groups as $group) {
            $GROUPMEM = new GroupMember($group['id']);
            $GROUPMEM->is_online = 0;
            $GROUPMEM->updateOnlineStatus();
        }
        if (isset($_SESSION['game_session'])) {
            GameSessionMembers::updateOnlineStatus($_SESSION['id'], $_SESSION['game_session']);
        }
    }
}