<?php
/*
 * Simple example to illustrate cookie reading and writing.
 */
// retrieve cookies
$count = @$_COOKIE['count'];
$start = @$_COOKIE['start'];

if (empty($count)) {
  // initialise cookie values
  $count = 0;
  $start = time();
  // Send a cookie "start=<em>current time</em>" to the client
  setcookie("start", $start, time()+600, "/", "", 0);
}

// update count and send a cookie to the client
$count++;
setcookie("count", $count, time()+600, "/", "", 0);

// compute duration of session
$duration = time() - $start;
?>

<html>
<body>
  <p>
  count = <?= $count ?>.<br/>
  start = <?= $start ?>.
  <p>
  This page has been accessed <?= $count ?> times <br>
  ...and has lasted <?= $duration ?> seconds.
  <hr>
  <a href="show.php?file=cookies.php">Source</a>
</body>
</html>