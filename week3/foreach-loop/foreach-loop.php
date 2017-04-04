

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Foreach loop example</title>
        <link rel="stylesheet" href="wp.css" type="text/css">

    </head>
    <body>
            <table class="bordered">
                    <!-- table header -->
                    <tr><th>Name</th><th>Value</th></tr>
            <?php foreach($_GET as $name => $value) { ?>
                    <tr><td><?= $name ?>:</td><td><?= $value?></td></tr>
            <?php } ?>
            </table>
            
            <p><a href="show.php?file=foreach-loop.php">Source</a></p>
    </body>
</html>
