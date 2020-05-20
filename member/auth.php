<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!Member::authenticate()) {
    redirect('login.php');
}