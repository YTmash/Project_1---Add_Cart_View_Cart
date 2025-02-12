<?php
// Start the session
session_start();

// Include your header and any necessary files
$page_title = 'Login | By MK';
include_once  './inc/header.php';


echo '<div class="alert alert-danger" role="alert" style="background-color: white; color: white; font-size: 100px;"> Have a nice day!</div>';


// Check if there's a message to display
if (isset($_GET['message'])) {
    echo '<div>' . htmlspecialchars($_GET['message']) . '</div>';
}


// Include your footer
include_once './inc/footer.php';
?>


