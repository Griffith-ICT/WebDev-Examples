<?php
/* 
 * A combined script that either displays an add-message form 
 * if the script is called with method GET
 * or adds the message in the form if the script is called with method POST.
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Display add-new-message form
?>
    <!DOCTYPE html>
    <html>
    <head>
    <title>Guest Book Message Entry</title>
    <meta  charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../wp.css">
    </head>

    <body>

    <h1>Message Entry Form</h1>

    <form method="post" action="add_message.php">
    <table>
      <tr><td>Message:</td><td><input type="text" size=80 name="message"></td></tr>
      <tr><td>Author:</td><td><input type="text" size=40 name="author"></td></tr>
      <tr><td colspan=2><input type="submit" value="Add message"></td></tr>
    </table>
    </form>

    <hr>
    <p>
    Sources:
    <a href="show.php?file=add_message.php">add_message.php</a>
    <a href="show.php?file=includes/defs.php">includes/defs.php</a>
    </p>

    </body>
    </html>
<?php 
} else { // $_SERVER['REQUEST_METHOD'] == 'POST'
    // Add new message from form data and redirect to home page
    include "includes/defs.php";

    // Get form data
    $message = $_POST['message'];
    $author = $_POST['author'];

    if (!empty($message)) {
	// Add new message from form data 
	if (empty($author)) {
	    $author = "Anon.";
	}
	writeEntry($message, $author);

	// Redirect to home page
	header("Location: index.php");
	exit;
    } else {
	// Report an error.
	// BAD STYLE: This is the wrong way to report errors.
	 print "<p>Error: Empty message in form data.</p>\n";
    }
}
?>
