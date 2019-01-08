<?php

require_once "Facebook/autoload.php";
session_start();

$fb = new \Facebook\Facebook([

    'app_id' => '742179166163818',
    'app_secret' => '96d3e5357aedaeb473ce6278aac3ab90',
    'default_graph_version' => 'v3.2'
]);

$helper = $fb->getRedirectLoginHelper();
?>