<?php

require "vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$data = json_decode(file_get_contents("php://input"));

$text=$data->text;

$client=new Client("AIzaSyBUgcgEmYzqbK6yxP-fTAadbMtdNGi3jeE");

$respose = $client->geminiPro()->generateContent(
    new TextPart($text),
);
$output = $respose->text();
$output = str_replace('*', '', $output);
echo $output;

//echo $respose->text();
?>
