<html>
<h1> GOT YOUR INFO</h1>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$authorization_code = $_GET['code'];

$client_id = '61d50a325b359a90c18726e2bf5c95c8c914ce04f80cd5a0b26c7a0af166d397';
$client_secret = '4559a71b8cc800004a5b90cd14c0faad1ff1bde08e6f5ff9716233f726362498';
$redirect_uri = "http://localhost:8080/Hypertube/42-callback.php";
$url = 'https://api.intra.42.fr/oauth/token';
$data = array(
    'code' => $authorization_code,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'grant_type' => "authorization_code"
 );
$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$array = json_decode($result, true);
$access_token = $array['access_token'];
$info = file_get_contents('https://api.intra.42.fr/v2/me?access_token=' . $access_token);
$arr = json_decode($info, true);
// echo "<pre>";
// print_r($arr);
$_SESSION["id"] = $arr["id"];
$_SESSION["first_name"] = $arr["first_name"];
$_SESSION["last_name"] = $arr["last_name"];
$_SESSION["picture"] = $arr['image_url'];
$_SESSION["email"] = $arr["email"];
header('Location: home.php');
?>