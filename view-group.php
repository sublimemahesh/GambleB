<?php
include_once(dirname(__FILE__) . '/class/include.php');
include_once(dirname(__FILE__) . '/auth.php');
include_once(dirname(__FILE__) . '/online-status.php');
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="10">
        <title>Group</title>
    </head>
    <body>
        Group Members
        <ul>
            <?php
            $members = GroupMember::getAllMembersByGroup($id);
            foreach ($members as $member) {
                $MEM = new Member($member['id']);
                $active = '';
                if($member['is_online']  == 1) {
                    $active = 'Active';
                } else {
                     $active = 'Inactive';
                }
                ?>
                <li><?php echo $MEM->name . ' - ' . $active; ?>  </li>
                <?php
            }
            ?>
        </ul>
    </body>
</html>
