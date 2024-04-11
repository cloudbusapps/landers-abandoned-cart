<?php
$data = <<<EOD
TransactionTime,ContactKey,Status,DefinitionName,ActivityName,EventName,Result.Tags,Result.Messages
2024-02-16T09:23:06.564Z,landers.ph-20240216172136,Failed,[RJ TEST] API Event - Abandoned Cart,[RJ TEST] API Event Email,[RJ TEST] API Event - Abandoned Cart,,"Type:User;Level:Warn;ErrorCode:JourneyBuilder_EMAILV2_180008;Message:A subscriber error occured invoking triggered send. StatusMessage: {statusMessage}, ErrorCode: {errorCode};Parameters:[errorCode=180008;statusMessage=Unable to queue Triggered Send request.  There are no valid subscribers.]|Type:User;Level:Error;ErrorCode:JourneyBuilder_EMAILV2_24;Message:Error Code: 24 - Subscriber was excluded by List Detective.;Parameters:[errorCodeID=24;errorCode=TriggeredSendSubscriberProcessingError]"
2024-02-16T09:19:39.633Z,landers.ph-20240216171817,Failed,[RJ TEST] API Event - Abandoned Cart,[RJ TEST] API Event Email,[RJ TEST] API Event - Abandoned Cart,,"Type:User;Level:Warn;ErrorCode:JourneyBuilder_EMAILV2_180008;Message:A subscriber error occured invoking triggered send. StatusMessage: {statusMessage}, ErrorCode: {errorCode};Parameters:[errorCode=180008;statusMessage=Unable to queue Triggered Send request.  There are no valid subscribers.]|Type:User;Level:Error;ErrorCode:JourneyBuilder_EMAILV2_5;Message:Error Code: 5 - The Email Address for this subscriber has invalid syntax.;Parameters:[errorCodeID=5;errorCode=TriggeredSendSubscriberProcessingError]"
EOD;

// Split the data into lines
$lines = explode("\n", trim($data));

// Remove the header line
$header = array_shift($lines);

// Initialize an array to hold the converted data
$convertedData = [];

// Iterate over the lines and convert each line to an associative array
foreach ($lines as $line) {
    // Split the line into fields
    $fields = explode(",", $line);

    // Combine the header fields with the current line fields
    $record = array_combine(explode(",", $header), $fields);

    // Add the record to the converted data array
    $convertedData[] = $record;
}

// Convert the array to JSON
$jsonData = json_encode($convertedData, JSON_PRETTY_PRINT);

// Output the JSON data
echo $jsonData;
