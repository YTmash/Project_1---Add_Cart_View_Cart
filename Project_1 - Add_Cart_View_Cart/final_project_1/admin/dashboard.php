<?php
  // header
  $page_title = "Admin Dashboard | Comments";
  include './inc/header_admin.php';

  echo '<div class="w3-container">';
    echo '<p>Following is a list of comments from the Contact Us form.</p>';
    echo '<p>(Click on a button for a single comment from the Contact Us form. Each number is a timestamp for when it was received. The newest comments are first in the list.)</p><hr>';

    $dir = "comments";
    $check = 0; // flag on what has been checked
    $nothing = "";

    if (is_dir($dir)) {
      $dirEntries = scandir($dir, 1);
      if(!empty($dirEntries)) {
        foreach ($dirEntries as $entry) {
          if(strpos($entry, '.txt')) {
            $entry = substr($entry, 0, -4);
            $check = print "<a class='w3-btn w3-hover-light-green w3-round-xxlarge' style='margin:15px;' href='viewcomment.php?commentnum=$entry'>" . $entry . "</a>";
          } else {
            // error file cannot be read
            $nothing = '<p class="error">Oh No! There are no comments to show.</p>';
          }
          if ($check != 1) {
            echo "$nothing";
          }        
        }
      } else {
        // error message
        echo '<p class="error">Oh No! No comments directory to check.</p>';
      }
      echo '<hr>';
    }

  echo '</div>';
  
  //footer
  include './inc/footer_admin.php';