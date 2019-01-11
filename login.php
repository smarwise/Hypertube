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
$loginurl42 = "https://api.intra.42.fr/oauth/authorize?client_id=61d50a325b359a90c18726e2bf5c95c8c914ce04f80cd5a0b26c7a0af166d397&redirect_uri=http%3A%2F%2Flocalhost%3A8080%2FHypertube%2F42-callback.php&response_type=code";
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
    <input type="button" onclick="window.location='<?php echo $gloginurl ?>';" value="Login with Google"><br />
    <input type="button" onclick="window.location='<?php echo $loginurl42 ?>';" value="Login with 42">
    </form>
    </body>
</html>
