<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config.php";

$accesstoken = $helper->getAccessToken();

if (!$accesstoken)
{
    header ('Location : login.php');
    exit();
}
$oauth2client = $fb->getOAuth2Client();
if (!$accesstoken->isLongLived())
    $accesstoken = $oauth2client->getLongLivedAccessToken($accesstoken);
$response = $fb->get("/me?fields=id,first_name, last_name, gender, email, picture.type(large)", $accesstoken);
$userinfo = $response->getGraphNode()->asArray();
echo "<pre>";
var_dump($userinfo);
$_SESSION["id"] = $userinfo["id"];
$_SESSION["first_name"] = $userinfo["first_name"];
$_SESSION["last_name"] = $userinfo["last_name"];
$_SESSION["picture"] = $userinfo["picture"]['url'];
$_SESSION["email"] = $userinfo["email"];
$_SESSION["gender"] = $userinfo["gender"];
header ('Location: home.php');
?>