<?php
  // header
  $page_title = "Example Contact Us | My Site";
  include './inc/header.php';

  // setup variables
  $displayForm = TRUE; // flag to display form or not
  $firstName = "";
  $lastName = "";
  $email = "";
  $subject = "";
  $comment = "";
  $fullName = "";

  // function to sanitize form data
  function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // check if form has been submitted with post
  if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    // handle the form
    echo 'Form has been submitted';
  }


  // show form if needed
  if($displayForm) {  
    include "./contact_us.php"
  }

  include './inc/footer.php';