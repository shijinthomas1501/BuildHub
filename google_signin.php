<?php
require_once 'includes/google_config.php';

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (isset($token['error'])) {
        echo "Error fetching token: " . $token['error_description'];
        exit;
    }

    $client->setAccessToken($token);

    $oauth = new Google_Service_Oauth2($client);
    $userInfo = $oauth->userinfo->get();

    echo "<h3>Welcome, " . $userInfo->name . "</h3>";
    echo "<p>Email: " . $userInfo->email . "</p>";
} else {
    echo "No auth code provided.";
}
