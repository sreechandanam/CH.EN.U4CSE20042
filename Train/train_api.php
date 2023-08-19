<?php
use Exception; 
$baseUrl = "http://20.244.56.144/train";
$access_token = "hMkCJZ"; 
$baseUrl = "http://20.244.56.144/train";
$access_token = "hMkCJZ"; 

function fetchTrainData($token) {
    global $baseUrl;

    $ch = curl_init("$baseUrl/trains");
    
    $headers = array(
        "Authorization: Bearer $token"
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        throw new Exception("Curl error: " . curl_error($ch));
    }
    

    $responseData = json_decode($response, true);

    curl_close($ch);

    return $responseData;
}

function processAndSortTrains($data) {
    return $data;
}

try {
    $trainData = fetchTrainData($access_token);
    $sortedTrains = processAndSortTrains($trainData);
    
    foreach ($sortedTrains as $train) {
        echo "Train Name: " . $train["trainName"] . "\n";
        echo "Train Number: " . $train["trainNumber"] . "\n";
        echo "Departure Time: " . $train["departureTime"]["Hours"] . ":" . $train["departureTime"]["Minutes"] . "\n";
        echo "Sleeper Availability: " . $train["seatsAvailable"]["sleeper"] . "\n";
        echo "AC Availability: " . $train["seatsAvailable"]["AC"] . "\n";
        echo "Sleeper Price: " . $train["price"]["sleeper"] . "\n";
        echo "AC Price: " . $train["price"]["AC"] . "\n";
        echo "Delayed By: " . $train["delayedBy"] . "\n";
        echo str_repeat("-", 50) . "\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>
