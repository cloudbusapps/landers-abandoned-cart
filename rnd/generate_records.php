<?php

// Function to generate a random string
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Function to generate a random email address
    function generateRandomEmail() {
        return generateRandomString(8) . '@example.com';
    }

    // Generate 100 records
    $records = [];
    $record_count = 200;
    for ($i = 0; $i < $record_count; $i++) {
        $record = [
            "membership_id" => rand(1000000, 9999999),
            "email_address" => generateRandomEmail(),
            "full_name" => generateRandomString(2),
            "product_name" => generateRandomString(10) . " " . generateRandomString(6),
            "product_image_url" => "https://img.freepik.com/free-vector/realistic-yogurt-advertisement_52683-8155.jpg"
        ];
        $records[] = $record;
    }

    // Convert the records array to JSON format
    $jsonData['label'] = 'Generated Records';
    // $jsonData['journey_builder_id'] = '233c3a4d16-82d4-4ce2-b2db-17fb44cc9c8b';
    // $jsonData['event_definition_key'] = 'APIEvent-839ac22d-1063-4774-8d19-52ba77c1adb4';
    $jsonData['data'] = $records;
    $jsonData = json_encode($jsonData, JSON_PRETTY_PRINT);
    $jsonData = str_replace("\/", "/", $jsonData);

    // Save the JSON data to a file named data.json
    $file = 'test_data.json';
    file_put_contents($file, $jsonData);

    echo "JSON data has been saved to $file\n";
?>
