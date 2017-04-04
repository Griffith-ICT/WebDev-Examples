<?php
/*
 * Show personal details entered in form, Chris McLean, Rodney Topor, 2003-2008.
 * BAD STYLE: Does not use templates.  Does not validate user input.
 * Does not sanitise user input.
 */
    
// get the form data
$name = $_GET['name'];
$age = $_GET['age'];
$nationality = $_GET['nationality'];
$email = $_GET['email'];
$likes = @$_GET['likes']; // suppress error message if no like selected

$dislikes = @$_GET['dislikes'];
// if nonempty, $dislikes is an array of checked values
if (is_array($dislikes)) {
    // return comma-separated string of dislikes values
    $dislikes = join(",",$dislikes);
}

$desc = $_GET['description'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Show Personal Details</title>
    <meta charset="utf-8">
    <!-- Global stylesheet -->
    <link rel="stylesheet" href="../wp.css" type="text/css">
    <!-- Local styles -->
    <style type="text/css">
	table { margin-left: auto; margin-right: auto; }
	th.col1 { text-align: right; }
	th.col2 { text-align: left; }
        td.col1 { text-align: right; vertical-align: top; background-color: #ABCDEF }
        td.col2 { text-align: left; vertical-align: top; background-color: #FEDCBA }
    </style>
</head>

<body> 
    <h2>Show personal details</h2>

    <p>
    <table class="bordered">
    <!-- <table border=1 cellpadding=2 cellspacing=2> -->
	<caption>Personal details table</caption>
        <tr>
            <td class="col1"> Name </td>
            <td class="col2"> <?php  echo "$name"; ?> </td>
	</tr>
        <tr>
            <td class="col1"> Age </td>
            <td class="col2"> <?= $age ?> </td>
	</tr>
        <tr>
            <td class="col1"> Nationality </td>
            <td class="col2"> <?= $nationality ?> </td>
	    <!-- <?= $var ?> is shorthand for <?php echo "$var"; ?> -->
	</tr>
        <tr>
            <td class="col1"> Email </td>
            <td class="col2"> <?= $email ?> </td>
	</tr>
        <tr>
            <td class="col1"> Likes </td>
            <td class="col2"> <?= $likes ?> </td>
	</tr>
        <tr>
            <td class="col1"> Dislikes </td>
            <td class="col2"> <?= $dislikes ?> </td>
            </td>
	</tr>
        <tr>
            <td class="col1"> Description </td>
            <td class="col2"> <?= $desc ?> </td>
	</tr>
    </table>

    <hr>
    <p>
    <a href="show.php?file=show_details.php">Source</a> 

</body>
</html>
