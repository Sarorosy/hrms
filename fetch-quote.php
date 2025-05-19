<?php
header("Content-Type: application/json");

$ch = curl_init();

// Set the options for the cURL request
curl_setopt($ch, CURLOPT_URL, "https://zenquotes.io/api/random");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Optional, bypasses SSL verification

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    echo $response;
} else {
    echo json_encode(["error" => "Unable to fetch quote"]);
}
?>
