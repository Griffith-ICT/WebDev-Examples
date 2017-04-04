<?php
/*
Script to print a greeting to a person who entered form data.
BAD STYLE: Does not use templates.  Does not validate user input
*/

$name = $_GET['name'];
$age  = $_GET['age'];  // $age is a string
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Greeting</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../wp.css">
  </head>
  
  <body>  
    <p>
    Hello <?php echo htmlspecialchars($name); ?>.
    Next year, you will be <?php echo (int)$age + 1; ?> years old.

    <hr>
    <p><a href="show.php?file=greeting.php">Source</a></p>
  </body>
</html>

