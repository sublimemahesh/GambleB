<!DOCTYPE html>
<?php
include '../class/include.php';

$MEMBER = new Member(NULL);

if ($MEMBER->logOut()) {
    header('Location: index.php');
}
?>
 
