<?php
/*
 * A simple guest book application using a plain text file.
 * This version does not have the reload-redo problem.
 * BAD STYLE: This version does not use templates.
 */
 ?>
<!DOCTYPE html>
<html>
<head>
<title>My Guest Book</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../wp.css">
</head>

<body>
<h1>My Guest Book</h1>

<?php      
include "includes/defs.php";

showEntries();
?>

<p>
<a href="add_form.html">Add your own message</a>

<hr>
<p>
Sources: 
<a href="show.php?file=index.php">index.php</a>
<a href="show.php?file=includes/defs.php">includes/defs.php</a>

</body>
</html>
