<?php

// Set the default timezone to UTC
date_default_timezone_set('UTC');

// Create a DateTime object for the current time
$currentDateTime = new DateTime();

// Set the timezone to "Asia/Manila" (Philippine Time) for start date
$currentDateTime->setTimezone(new DateTimeZone('Asia/Manila'));

// Subtract 1 hour from the current time for the start date
$currentDateTime->sub(new DateInterval('PT1H'));

// Format the start DateTime object as ISO 8601
$startDate = $currentDateTime->format('Y-m-d\TH:i:s\Z');

// Create a DateTime object for the end date (current time)
$endDate = new DateTime();

// Format the end DateTime object as ISO 8601
$endDate = $endDate->format('Y-m-d\TH:i:s\Z');

echo "Start Date: $startDate\n";
echo "End Date: $endDate\n";
