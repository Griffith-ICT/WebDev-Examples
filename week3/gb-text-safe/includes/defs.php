<?php
/* Constant and function definitions for simple guest book application. */

define("FILE","messages.txt");

/* Appends entry to FILE. */
function writeEntry($message, $author) {
  $fp = fopen(FILE, "a");
  fwrite($fp, "$message\n");
  fwrite($fp, "$author\n");
  fclose($fp);
}

/*
 * Shows entries in FILE
 * PHP blocks are not interpreted on the server,
 * and HTML and JavaScript elements are not interpreted on the client.
 */
function showEntries() {
  $fp = fopen(FILE, "r");
  if ( $fp ) {                      # added by Anthony Thyssen 21/02/2014
    $n = 0;
    while ($fp && !feof($fp)) {
      $message = fgets($fp, 4096);
      if (!empty($message) && !feof($fp)) { # should not be necessary!
        $message = htmlspecialchars($message);
        $author = htmlspecialchars(trim(fgets($fp, 4096)));
        echo "<p>$message</p>\n";
        echo "<p>-- $author</p>\n";

        $n++;
      }
    }
    echo "<p>(Debugging: No. messages = $n.)</p>\n";
    fclose($fp);
  }
}
?>
