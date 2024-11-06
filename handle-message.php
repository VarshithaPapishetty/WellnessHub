<?php
// handle_message.php

// Get user message from POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postData = json_decode(file_get_contents('php://input'), true);
    $userMessage = $postData['userMessage'];

    // Bard API setup
    $token = "g.a000lghyQ_8MAsXHLf1cOYm2DxCH_Bpocw5gQe4Rm3Bz6wMmdttxDl_pWufUav7W3HKK_ouT3wACgYKAVASARcSFQHGX2Mi5VG8A40sAT8hA3SuVpUIkRoVAUF8yKooE6ftRbfiqkp2Fe1faxO-0076";
    $url = "https://bard.google.com/r";

    // Prepare API request
    $requestData = http_build_query([
        'question' => $userMessage,
        'token' => $token,
    ]);

    // Initialize cURL session
    $ch = curl_init($url . '?' . $requestData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    // Debugging output
    echo "Request URL: " . $url . '?' . $requestData . "<br>";
    echo "Response: " . $response . "<br>";

    // Close cURL session
    curl_close($ch);

    // Output API response
    header('Content-Type: application/json');
    echo $response;
}
?>
