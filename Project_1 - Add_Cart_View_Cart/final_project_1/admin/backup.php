<?php

  // header
  $page_title = "Admin Dashboard | Backup";
  include './inc/header_admin.php';

  echo '<div class="w3-container">';

    $source = 'comments';
    $destination = 'backup';

    // check if backup folder already exists and make it if not
    if(!file_exists($destination))
      mkdir($destination);

    // check if source folder is a directory
    if (is_dir($source)) {

      $dirEntries = scandir($source);

      foreach ($dirEntries as $entry) {
        if (strpos($entry, '.txt') == TRUE) {
          @copy("$source/" . $entry, "$destination/" . $entry);
        }
      }

      // success message
      echo '<p class="success">The comment file(s) were successfully backed up!</p>';

    } else {

      // error message
      echo '<p class="error">The comment file(s) could not be backed up!</p>';
    }

  echo '</div>';

  //footer
  include './inc/footer_admin.php';