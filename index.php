<?php
include_once "./lib/php/users.php";

?>

<html>
    <head>
        <title>Dating Website Index</title>
    </head>
    <body>
        <center>
            <h1>Dating Website Index</h1>
            Logged in: <?php echo (isLoggedIn() ? "True" : "False <a href='login.php'>Login Here</a>"); ?>
        </center>
    </body>
</html>