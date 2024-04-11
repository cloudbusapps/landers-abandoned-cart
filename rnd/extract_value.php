<?php

function extractErrorMessage($str) {
    // Define the regular expression pattern
    $pattern = '/Message:(Error Code: \d+ - .*?)(?=;Parameters:|$)/';

    // Perform the regular expression match
    preg_match($pattern, $str, $matches);

    // Extract the error message from the matches array
    if (isset($matches[1])) {
        return trim($matches[1]); // Trim any leading or trailing whitespace
    }

    return null; // Error message not found
}

$str = "Type:User;Level:Warn;ErrorCode:JourneyBuilder_EMAILV2_180008;Message:A subscriber error occured invoking triggered send. StatusMessage: {statusMessage}, ErrorCode: {errorCode};Parameters:[errorCode=180008;statusMessage=Unable to queue Triggered Send request.  There are no valid subscribers.]|Type:User;Level:Error;ErrorCode:JourneyBuilder_EMAILV2_5;Message:Error Code: 5 - The Email Address for this subscriber has invalid syntax.;Parameters:[errorCodeID=5;errorCode=TriggeredSendSubscriberProcessingError]";

// Extract the error message
$errorMessage = extractErrorMessage($str);
echo $errorMessage;
