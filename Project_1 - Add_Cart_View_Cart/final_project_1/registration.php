<?php

$page_title = 'MK Sports Store | Sign Up';
include './inc/header.php';


// Connect to the database
require('./dbc.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set up error array
    $errors = array();

    // Check for a first name
    if (!empty($_POST['f_name'])) {
        $f_name = trim($_POST['f_name']);
    } else {
        $errors['f_name'] = 'Please enter your first name.';
    }

    // Check for a last name
    if (!empty($_POST['l_name'])) {
        $l_name = trim($_POST['l_name']);
    } else {
        $errors['l_name'] = 'Please enter your last name.';
    }

    // Check for a valid email address
    if (!empty($_POST['cust_email'])) {
        $cust_email = trim($_POST['cust_email']);
        if (!filter_var($cust_email, FILTER_VALIDATE_EMAIL)) {
            $errors['cust_email'] = 'Please enter a valid email address.';
        } else {
//=================fixed ========================
            $existing_email_check = "SELECT cust_email FROM customers WHERE cust_email = '$cust_email'";
//=================end section ==================
            $existing_email_result = mysqli_query($dbc, $existing_email_check);
 
            if (mysqli_num_rows($existing_email_result) > 0) {
                $errors['cust_email'] = 'This email address is already registered.';
            }
        }
    } else {
        $errors['cust_email'] = 'Please enter your email address.';
    }

    $cust_phone = !empty($_POST['cust_phone']) ? trim($_POST['cust_phone']) : '';

    // Check for a password and match against the confirmed password
    if (!empty($_POST['pass1'])) {
        if ($_POST['pass1'] != $_POST['pass2']) {
            $errors['passworderror2'] = 'Your passwords do not match.';
        } else {
            $pass = trim($_POST['pass1']);
        }
    } else {
        $errors['passworderror1'] = 'Please enter a password.';
    }

    // If no errors, register the user and redirect to the login page
    if (empty($errors)) {
        // Hash the password
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // Make the query
        $q = "INSERT INTO customers (f_name, l_name, cust_email, cust_phone, hashed_pass) VALUES ('$f_name', '$l_name', '$cust_email', '$cust_phone', '$hashed_pass')";

        // Run the query
        $r = @mysqli_query($dbc, $q);

        // If query was successful, redirect to the login page
        if ($r) {
            echo '<p>Thank you for registering! Please  <a href="login.php">log in</a> to continue.</p>';
            include('./inc/footer.php');
            exit();
        } else {
            echo '<h1>System Error</h1><p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
            echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
        }

        mysqli_close($dbc);
    } else {
        echo '<h1>Error!</h1><p class="error">The following error(s) occurred:</p>';
        // Display the errors
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}


// Include the footer
include('./inc/footer.php');
?>

