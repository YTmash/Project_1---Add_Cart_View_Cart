<?php

$cookie_name = "firstname";
include('./inc/loginfunctions.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}