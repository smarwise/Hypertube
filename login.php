<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config.php";

$redirecturl = "http://localhost:8080/Hypertube/fb-callback.php";
$permissions = ['email'];
$loginurl = $helper->getLoginUrl($redirecturl, $permissions);
// echo $loginurl;

$gloginurl = $client->createAuthUrl();
?>

<html>
    <head>
    <title> Hyperlogin </title>
    <style>
        body
        {
            /* background-color: rgb(0, 0, 0); */

        }
    </style>
    </head>
    <body>
    <form method="POST">
    <input name="email" placeholder="Email"><br />
    <input name="password" type="password" placeholder="Password"><br />
    <input type="submit" value="Login"><br />
    <input type="button" onclick="window.location='<?php echo $loginurl ?>';" value="Login with Facebook"><br />
    <input type="button" onclick="window.location='<?php echo $gloginurl ?>';" value="Login with Google">
    </form>
    </body>
</html>
