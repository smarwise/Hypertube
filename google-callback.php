<?php

require_once "config.php";
require_once "setup.php";
require_once("setup.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
$first_name = $userinfo["givenName"];
$last_name = $userinfo["familyName"];
$picture = $userinfo["picture"];
$email = $userinfo["email"];
$password = "default";
$sql = "INSERT INTO users (name, surname, email, username, password, notifications, token) VALUES (:first_name, :last_name, :email, :username, :passwd, :noti, :token)";
$coolpwd = hash('whirlpool', $password);
$noti = "off";
$verificationCode = '1';
$stmt= $db->prepare($sql);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam('last_name', $last_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':username', $first_name);
$stmt->bindParam(':passwd', $coolpwd);
$stmt->bindParam(':noti', $noti);
$stmt->bindParam(':token', $verificationCode);
$stmt->execute();
$_SESSION["id"] = $userinfo["id"];
$_SESSION["first_name"] = $userinfo["givenName"];
$_SESSION["last_name"] = $userinfo["familyName"];
$_SESSION["picture"] = $userinfo["picture"];
$_SESSION["email"] = $userinfo["email"];
header ('Location: home.php');
?>