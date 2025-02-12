<?php

// Define all functions used by the login/logout script

// This is the "redirect" user function
function redirect_user($page = 'login.php') {
    header("Location: $page");
    exit();
}

// Check email and password login info
function check_login($dbc, $email = '', $pass = '') {
    $errors = array();
}


    // Validate password
    if (empty($pass)) {
        $errors[] = 'password';
    } else {
        $pass = mysqli_real_escape_string($dbc, trim($pass));
        
    }