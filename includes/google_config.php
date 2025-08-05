<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Load Google API PHP Client Library

// ✅ Use correct namespace
use Google\Client;

// ✅ Create Google Client instance
$client = new Client();

// Your credentials from Google Cloud Console
$client->setClientId('499658828329-jj1qk65tsl3qs6v81hngmtbvvj5in8rs.apps.googleusercontent.com');
$client->setClientSecret('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');

// ✅ Must match the redirect URI set in your Google Cloud OAuth 2.0 settings
$client->setRedirectUri('http://localhost/buildhub/login.php');

// ✅ Set scopes to get profile info
$client->addScope('email');
$client->addScope('profile');

// Optional: Force consent every time
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
?>
