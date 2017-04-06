<?php
/*
 * Home page for first implementation of guest book example.
 * Adds new message if form data was posted.
 * Then displays all messages.
 * BAD STYLE: Does not use templates, does not sanitise input data,
 * uses functions that output HTML, has reload-redo problem.
 */
 // Read function definitions
include "includes/defs.php";

// Get form data, if any
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $author = $_POST['author'];
} else {
    $message = "";
    $author = "";
}

if (!empty($message)) {
    // Add new message from form data
    if (empty($author)) {
	    $author = "Anon.";
    }
    writeEntry($message, $author);
}

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
