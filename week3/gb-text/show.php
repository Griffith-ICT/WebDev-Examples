<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<!-- Script to print PHP scripts.  Not for student inspection. -->
<html>
<head>
  <title>File source</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
/*
 * This script displays the contents of $file without
 * interpreting embedded PHP, HTML or JavaScript elements.
 * It only allows files in or below the current directory.
 */

  $file = $_GET['file'];
  // echo "<b>$file:</b><br>\n";

  // Check a file name was given
  if ( empty($file) || $file == "" ) {
      echo "Missing filename.<br>\n";
      exit;
  }

  // Check file path is allowed
  if ( strncmp($file, "/", 1) == 0 || strstr($file, "../") ) {
      echo "File name is not allowed: $file.<br>\n";
      exit;
  }

  // Sanitise file name (unnecessary here?)
  $file = EscapeShellCmd(substr($file, 0, 40));

  // Check file exists
  if ( !file_exists($file) || !is_file($file) ) {
      echo "File not found or not printable: $file.<br>\n";
      exit;
  }

  // Attempt to open file
  $fp = fopen($file, "r");
  if ( $fp == FALSE ) {
      echo "Couldn't open file: $file.<br>\n";
      exit;
  }

  // print lines of the file
  echo "<pre>\n";
  while ( !feof($fp) ) {
      echo htmlspecialchars(fgets($fp,4096));
  }
  fclose($fp);
  echo "</pre>\n";
?>
</body>
</html>

