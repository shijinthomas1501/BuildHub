<?php
$ch = curl_init('https://www.googleapis.com/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response) {
    echo "✅ cURL works! Google API reachable.";
} else {
    echo "❌ cURL Error: $error";
}
