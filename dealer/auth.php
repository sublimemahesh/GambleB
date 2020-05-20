<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!Dealer::authenticate()) {
    redirect('login.php');
}