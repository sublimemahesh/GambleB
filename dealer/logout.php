<!DOCTYPE html>
<?php
include '../class/include.php';

$DEALER = new Dealer(NULL);

if ($DEALER->logOut()) {
    header('Location: index.php');
}
?>
 
