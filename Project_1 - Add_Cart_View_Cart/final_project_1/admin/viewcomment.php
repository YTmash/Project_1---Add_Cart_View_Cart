<?php

  // include header and change title
  $page_title = 'Admin Dashboard | View Comment';
  include './inc/header_admin.php';

  echo '<h2>Viewing Individual Comment</h2>';

  if (empty($_GET['commentnum'])) {
    echo "<p class='error'>We did not receive a valid comment number. Please try that again!</p>";
  } else if (is_readable('comments/' . $_GET['commentnum'] . '.txt')) {

    // open a stream to the text file and get contents of each line in file
    $commentFields = fopen('comments/' . $_GET['commentnum'] . '.txt', 'r');
    $name = fgets($commentFields);
    $email = fgets($commentFields);
    $time = fgets($commentFields);
    $time = date('m/d/Y', $time) . ' | ' . date('g:i:s A', $time);
    $subject = fgets($commentFields);
    $comment = "";
    while (!feof($commentFields))
      $comment .= fgets($commentFields);

    fclose($commentFields);

    // output info to page
    echo "<table>";
    echo "<th colspan='2'>COMMENT</th>";
    echo "<tr><td>Name:</td><td>$name</td></tr>";
    echo "<tr><td>Email:</td><td><a href='mailto:$name<$email>?subject=RE: $subject'>$email</a></td></tr>";
    echo "<tr><td>Date/Time:</td><td>$time</td></tr>";
    echo "<tr><td>Subject:</td><td>$subject</td></tr>";
    echo "<tr><td valign='top'>Comment:</td><td><pre>$comment</pre></td></tr>";
    echo "</table>";

  } else {
    echo "<p class='error'>Oh No! The comment file seems to be empty or missing or not valid. Please contact the system administrator.</p>";
  }

  // include footer
  include './inc/footer_admin.php';
?>