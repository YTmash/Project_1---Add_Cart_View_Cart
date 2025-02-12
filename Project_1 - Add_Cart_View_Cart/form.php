<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($_POST['psw'] !== $_POST['psw-repeat']) {
        exit();
    }

}