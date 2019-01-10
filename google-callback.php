<?php

require_once "config.php";

if (isset($_GET['code']))
{
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['token'] = $token;
}
else
    header ('Location: login.php');

$oauth = new Google_Service_Oauth2($client);
$userinfo = $oauth->userinfo_v2_me->get();

echo "<pre>";
var_dump($userinfo);
$_SESSION["id"] = $userinfo["id"];
$_SESSION["first_name"] = $userinfo["givenName"];
$_SESSION["last_name"] = $userinfo["familyName"];
$_SESSION["picture"] = $userinfo["picture"];
$_SESSION["email"] = $userinfo["email"];
$_SESSION["gender"] = $userinfo["gender"];
header ('Location: home.php');
?>