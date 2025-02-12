<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['userid'])) {
    // Cancel the session
    unset($_SESSION['userid']);
    unset($_SESSION['agent']);
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    session_destroy();
}

// Change title and include header
$self = basename($_SERVER['PHP_SELF']);
$page_title = 'Logged Out | By MK Sports Store';
include 'final_project_1/inc/header.php'; 

// Display page
echo "<div class='w3-container w3-red'>
        <h1>" . htmlspecialchars($page_title) . 
        "<a href='viewcart.php'>
            <i class='fas fa-shopping-cart' id='carticon' title='View Cart'></i>
        </a></h1>
      </div>
      <div class='container'>
        <p>You are now logged out. Have a great day!</p>
      </div>";

// Include footer
 include 'final_project_1/inc/footer.php';
