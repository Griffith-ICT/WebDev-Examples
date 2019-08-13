<?php
/*
 * Simple application to illustrate the use of session variables.
 */

// Initialise a session.   This call either creates a new session
// (and sets a cookie) or re-establishes an existing one (and reads a cookie).
session_start();

// get session id
$sessionId = session_id();

// retrieve session variables
$count = @$_SESSION['count'];
$start = @$_SESSION['start'];

if (empty($count)) {
    // initialise session variables
    $count = 0; 
    $start = time();
    // register session variables
    $_SESSION['count'] = $count; 
    $_SESSION['start'] = $start;
}

// update and save session variable
$count++;
$_SESSION['count'] = $count;

// compute duration of session
$duration = time() - $start;
?>

<html>
<body>
<p>
This page maintains session <?= $sessionId ?>. 

<p>
It has been accessed <?= $count ?> times <br>
...and has lasted <?= $duration ?> seconds.

<hr>
<p>
<a href="show.php?file=sessions.php">Source</a>
</body>
</html>