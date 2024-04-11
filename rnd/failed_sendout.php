<?php
    date_default_timezone_set('Asia/Manila');
    $sub_domain = 'https://mctccrntxyd5zhj-bg8mr9d4g9m8';

    require_once('init.php');
    include_once('php-functions.php');	

    /**
     * The function "authenticate" is used to authenticate a client using client credentials in order
     * to obtain an access token for accessing the Marketing Cloud API.
     * 
     * @return an array with the following keys:
     * - 'status': The status of the authentication process ('Success' or 'Failed').
     * - 'message': A message indicating the result of the authentication process.
     * - 'token': The access token obtained from the authentication process.
     */
    function authenticate() {
        $data = [];
        global $sub_domain;
        global $pdo;
        
        try {
            $client_id     = getSystemSetting($pdo, 'MC_API_CLIENTID');
            $client_secret = getSystemSetting($pdo, 'MC_API_CLIENTSECRET');
            $mc_account_id = getSystemSetting($pdo, 'MC_ACCOUNT_ID');

            $payload = [
                "grant_type"    => "client_credentials",
                "client_id" 	=> $client_id,
                "client_secret" => $client_secret,
                "account_id" 	=> $mc_account_id
            ];
    
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $sub_domain . '.auth.marketingcloudapis.com/v2/token');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
            $response = curl_exec($curl);
    
            $resp = json_decode($response);
            if (isset($resp->access_token)) {
                $data['status']  = 'Success';
                $data['message'] = 'Authenticated';
                $data['token']   = $resp->access_token;
            }
            else {
                $data['status'] = 'Failed';
                $data['message'] = 'Authentication failed';
            }
            
            curl_close($curl);
        } 
        catch (\Exception $ex) {
            $data['status'] = 'Failed';
            $data['message'] = $ex->getMessage();
        }

        return $data;
    }

    function extract_error_message($str = '') {
        // Define the regular expression pattern
        $pattern = '/Message:(Error Code: \d+ - .*?)(?=;Parameters:|$)/';

        // Perform the regular expression match
        preg_match($pattern, $str, $matches);

        // Extract the error message from the matches array
        if (isset($matches[1])) {
            $result = trim($matches[1]); // Trim any leading or trailing whitespace
            $result = explode(' - ', $result);
            return $result[1];
        }

        return null; // Error message not found
    }

    function convert_text_to_json($text = '') {   
        if (empty($text)) return null;
        
        // Split the data into lines
        $lines = explode("\n", trim($text));
        
        // Remove the header line
        $header = array_shift($lines);
        $header = explode(",", trim($header));

        // Initialize an array to hold the converted data
        $convertedData = [];

        // Iterate over the lines and convert each line to an associative array
        foreach ($lines as $line) {
            // Split the line into fields
            $fields = str_getcsv($line);

            // Combine the header fields with the current line fields
            $record = array_combine($header, $fields);

            // Add the record to the converted data array
            $convertedData[] = $record;
        }

        foreach ($convertedData as $key => $value) {
            $convertedData[$key]['Message'] = extract_error_message($value['Result.Messages']);
            unset($convertedData[$key]['Result.Messages']);
        }

        // Output the JSON data
        return $convertedData;
    }

    function get_failed_sendout($token = '', $journey_builder_id = '') {
        $data = [];
        global $sub_domain;
    
        try {
            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
                'x-direct-pipe: true'
            ];

            $columns = [
                'TransactionTime', 
                'ContactKey',
                'Result.Messages'
            ];
    
            $body = [
                "definitionIds" => [$journey_builder_id],
                'statuses' => ['failed']
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $sub_domain . '.rest.marketingcloudapis.com/interaction/v1/interactions/journeyhistory/download?columns='.implode(',', $columns));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                $data['status'] = 'Failed';
                $data['message'] = 'Unable to connect: '. curl_error($curl);
            } else {
                $data['status'] = 'Success';
                $data['message'] = 'Journey Builder found';
                $data['data'] = convert_text_to_json($response);
            }

            curl_close($curl);
            
        } catch (\Throwable $th) {
            $data['status'] = 'Failed';
            $data['message'] = $th->getMessage();
        }

        return $data;
    }

    $auth = authenticate();
    $data = get_failed_sendout($auth['token'], '3c3a4d16-82d4-4ce2-b2db-17fb44cc9c8b');
    // $data = getActivityIds($auth['token']);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
?>