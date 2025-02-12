<?php   
$pagetitle="Contact";
include "inc/header.php";
  // header

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
    if (!empty($_POST['fName']) && !empty($_POST['lName']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['comment'])) {
      // santize the data
      $firstName = clean_input($_POST['fName']);
      $lastName = clean_input($_POST['lName']);
      $email = clean_input($_POST['email']);
      $subject = clean_input($_POST['subject']);
      $comment = clean_input($_POST['comment']);
      $fullName = $firstName . " " . $lastName;
      $displayForm = FALSE; // turn flag off to not display form
    } else {
      // failure message
      echo "<h3 class='w3-container w3-padding-16 w3-pale-red w3-text-red'>ERROR: You will need to complete all the form fields before proceeding.</h3>";
      $displayForm = TRUE;  // just in case flag was set to false
    }
  }

  // show form if needed
  if($displayForm) {
    include './inc/contact_form.php';
  } else {
    // we have the data we need so
    $to = 'me@example.com';
    $header = "MIME-Version: 1.0" . "\r\n";
    $header .= "Content-type: text/html;charset=UTF-8" . "\r\n";
    $header .= "FROM: $fullName <$email>". "\r\n";

    // $result = @mail($to, $subject, $comment, $header, "-f $email");
    $result = TRUE;

    if ($result) {
      // get ready to save to a text file
      $timeStamp = time();
      $commentString = $fullName . "\r\n";
      $commentString .= $email . "\r\n";
      $commentString .= $timeStamp . "\r\n";
      $commentString .= $subject . "\r\n";
      $commentString .= $comment;

      // echo "<pre>$commentString</pre>";
      // check to see if admin and comments folders exists and create folders if they do not
      if (!file_exists("admin")) {
        mkdir("admin");
      }
      if (!file_exists("./admin/comments")) {
        mkdir("./admin/comments");
      }

      // open a stream to the text file
      $commentFile = @fopen('./admin/comments/' . $timeStamp . '.txt', 'w') or die("<div class='w3-container w3-red'>Sorry, unable to open the file at this time. Please try again later.</div>");

      // lock out the file writing
      if (flock($commentFile, LOCK_EX)) {
        // write to file
        if(@fwrite($commentFile, $commentString)) {

          // unlock the file
          flock($commentFile, LOCK_UN);

          // success message
          echo "<div class='w3-container w3-khaki'><h1>Success!</h1>";
          echo "<p>Thank you, $fullName, for contacting us. We will reply in 3-5 business days. Please be patient as we can be very busy but you are important so if it is time sensitive please call our direct line at (204)555-1234 to speak with a customer representative. The time was <span class='w3-text-teal'>" . date('g:i:s A m/d/Y') . "</span>.</p></div>";
        } else {
          // error message could not write to file
          echo "<div class='container w3-red'><h1>Oh No!</h1>";
          echo "<p>There seems to be a problem on our end. Your message could not be saved at this time. Please try again or call us at 1-800-555-9876 to speak a representative.</p></div>";
        }
      } else {
        // error message could not lock file out
        echo "<div class='container w3-red'><h1>Oh No!</h1>";
        echo "<p>There seems to be a problem on our end. Your message could not be saved at this time. Please try again or call us at 1-800-555-9876 to speak a representative.</p></div>";
      }

    } else {
      // error message could not email
      echo "<div class='container w3-red'><h1>Oh No!</h1>";
      echo "<p>There seems to be a problem on our end. Your message could not be saved at this time. Please try again or call us at 1-800-555-9876 to speak a representative.</p></div>";
    }

    // close the file stream
    @fclose($commentFile);
  }
?>
<p id="admin" title="Admin Area"><a href="./admin/dashboard.php"><i class="material-icons">computer</i></a></p>
