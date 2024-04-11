<?php

    date_default_timezone_set('UTC');
    $sub_domain = 'https://mctccrntxyd5zhj-bg8mr9d4g9m8';

    require_once('init.php');
    include_once('php-functions.php');	
    
    function get_current_datetime() {
        $datetime = new DateTime();
        $datetime->setTimezone(new DateTimeZone('Asia/Manila'));
        $datetime = $datetime->format('Y-m-d H:i:s');
        return $datetime;
    }
    $start_datetime = get_current_datetime();
    $end_datetime = get_current_datetime();


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

    function validate_headers() {
        $headers = getallheaders();
        if (!isset($headers['Content-Type']) || $headers['Content-Type'] != 'application/json' || !isset($headers['journey_builder_id']) || !isset($headers['event_definition_key'])) {
            return [
                'status' => 'Failed',
                'message' => 'Invalid header values',
            ];
        }

        $journey_builder_id = $headers['journey_builder_id'];
        $journey_builder_id = substr($journey_builder_id, 2);
        $headers['journey_builder_id'] = $journey_builder_id;

        return [
            'status' => 'Success',
            'message' => 'Headers validated',
            'data' => [
                'journey_builder_id' => $headers['journey_builder_id'],
                'event_definition_key' => $headers['event_definition_key'],
            ]
        ];
    }

    /**
     * The function `validate_payload` checks if a JSON payload contains the required keys and data,
     * and returns a status and message indicating if the payload is valid or not.
     * 
     * @return The function `validate_payload()` returns an array with the following keys and values:
     * - status: The status of the payload validation. ("Success" or "Failed")
     * - message: A message indicating the result of the payload validation.
     * - payload: The payload that was validated.
     */
    function validate_payload() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['label']) || !isset($data['data']) || !is_array($data['data'])) {
            return [
                'status' => 'Failed',
                'message' => "Invalid payload. Make sure to include 'label' and 'data'"
            ];
        } 
        else if (count($data['data']) == 0) {
            return [
                'status' => 'Failed',
                'message' => "Invalid payload. Make sure to include 'data'"
            ];
        }
        else if (count($data['data']) > 200) {
            return [
                'status' => 'Failed',
                'message' => "Invalid payload. Maximum of 200 records allowed"
            ];
        }

        return [
            'status' => 'Success',
            'message' => 'Valid payload',
            'payload' => $data
        ];
    }

    /**
     * The function "validate_email" checks if a given email address is valid.
     * 
     * @param email The parameter "email" is a string that represents an email address.
     * 
     * @return a boolean value. If the email is valid, it will return true. If the email is not valid,
     * it will return false.
     */
    function validate_email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    /**
     * The function `validate_journey_builder` is a PHP function that validates a Journey Builder by
     * making a request to the Marketing Cloud API.
     * 
     * @param token The token parameter is a string that represents the access token required for
     * authentication with the Marketing Cloud API. This token is used in the Authorization header of
     * the API request to validate the user's credentials and permissions.
     * @param journey_builder_id The `journey_builder_id` parameter is the ID of the Journey Builder
     * that you want to validate. It is used to make a request to the Marketing Cloud API to check if
     * the Journey Builder exists.
     * 
     * @return an array with two keys: 'status' and 'message'. The 'status' key indicates whether the
     * validation was successful or not, and the 'message' key provides a description of the result.
     */
    function validate_journey_builder($mc_token = '', $journey_builder_id = '') {
        $data = [];
        global $sub_domain;
        
        try {
            $header = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $mc_token
            ];
    
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $sub_domain . '.auth.marketingcloudapis.com/interaction/v1/interactions/'.$journey_builder_id);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            $response = curl_exec($curl);
    
            $resp = json_decode($response);
            if (!isset($resp->errorcode)) {
                $data['status']  = 'Success';
                $data['message'] = 'Journey Builder found';
            }
            else {
                $message = $resp->errorcode . ' - ' . $resp->message . ' | Journey Builder not found';

                $data['status'] = 'Failed';
                $data['message'] = $message;
            }
            
            curl_close($curl);
        } 
        catch (\Exception $ex) {
            $data['status'] = 'Failed';
            $data['message'] = $ex->getMessage();
        }

        return $data;
    }

    /**
     * The function processes events by sending data to the Marketing Cloud API and returns the status
     * and count of successful and failed events.
     * 
     * @param mc_token The `mc_token` parameter is the Marketing Cloud access token. It is used for
     * authentication when making API requests to the Marketing Cloud REST API.
     * @param data The `data` parameter is an array that contains the payload data for processing
     * events.
     * 
     * @return an array with the following structure:
     * - status: The status of the event processing. ("Success" or "Failed")
     * - message: A message indicating the result of the event processing.
     * - data - total_records: The total count of events processed.
     * - data - successful_records: The count of successful events processed.
     * - data - failed_records: The count of failed events processed.
     * - data - errors: An array of errors encountered during the event processing.
     */
    function process($mc_token = '', $journey_builder_id = '', $event_definition_key = '', $data = []) {
        global $sub_domain;

        $is_error = false;
        $errors = [];

        $total_records = $successful_records = $failed_records = 0;
        $payload_data = $data['payload']['data'];
        
        $validate_journey = validate_journey_builder($mc_token, $journey_builder_id);
        if ($validate_journey['status'] == 'Failed') {
            return $validate_journey;
        }

        $curl = curl_init();
        $YmdHis = date('YmdHis');
        foreach ($payload_data as $key => $value) {

            $contact_key = 'landersph-' . $YmdHis . '-' . $key;
            $payload_data[$key]['subscriber_key'] = $contact_key; // required!

            if (!validate_email($payload_data[$key]['email_address'])) {
                $is_error = true;
                $errors[] = [
                    'index'          => $key,
                    'subscriber_key' => $contact_key,
                    'message'        => 'Invalid email address',
                    'data'           => $payload_data[$key],
                ];

                $failed_records++;
                $total_records++;
                continue;
            }

            $payload = [
                'ContactKey' => $contact_key,
                'EventDefinitionKey' => $event_definition_key,
                'Data' => $payload_data[$key]
            ];
    
            try {
                // we will be using REST API so we point to the REST Base URI
                curl_setopt($curl, CURLOPT_URL, $sub_domain . '.rest.marketingcloudapis.com/interaction/v1/events');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer $mc_token"));
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                $response = curl_exec($curl);
    
                $resp = json_decode($response);
                if (isset($resp->errorcode)) {
                    $is_error = true;
                    $errors[] = [
                        'index'          => $key,
                        'subscriber_key' => $contact_key,
                        'message'        => $resp->message,
                        'data'           => $payload_data[$key],
                    ];

                    $failed_records++;
                } 
                else {
                    $successful_records++;
                }
            } 
            catch (\Exception $ex) {
                $is_error = true;
                $errors[] = [
                    'index'          => $key,
                    'subscriber_key' => $contact_key,
                    'message'        => $ex->getMessage(),
                    'data'           => $payload_data[$key],
                ];

                $failed_records++;
            }

            $total_records++;
        }

        curl_close($curl);

        if ($is_error) {
            $status = $successful_records > 0 ? 'Partial Success' : 'Failed';
            $message = $successful_records > 0 ? 'Some operations were completed successfully while others encountered errors.' : 'API Event processing failed';
        }
        else {
            $status = 'Success';
            $message = 'API Event processing completed successfully';
        }

        $output = [
            'status' => $status,
            'message' => $message,
            'data' => [
                'total_records'   => $total_records,
                'successful_records' => $successful_records,
                'failed_records'  => $failed_records,
                'errors'        => $errors
            ],
            'payload' => $payload_data
        ];

        return $output;
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

    function convert_text_to_json($text = '', $output_payload = []) {   
        if (empty($text)) return null;
        
        // Split the data into lines
        $lines = explode("\n", trim($text));
        
        // Remove the header line
        $header = array_shift($lines);
        $header = explode(",", trim($header));

        // Initialize an array to hold the converted data
        $converted_data = [];

        // Iterate over the lines and convert each line to an associative array
        foreach ($lines as $line) {
            // Split the line into fields
            $fields = str_getcsv($line);

            // Combine the header fields with the current line fields
            $record = array_combine($header, $fields);

            // Add the record to the converted data array
            $converted_data[] = $record;
        }

        foreach ($converted_data as $key => $value) {
            $converted_data[$key]['Message'] = extract_error_message($value['Result.Messages']);
            $converted_data[$key]['data'] = get_data_from_failed_sendout($output_payload, $value['ContactKey']);
            unset($converted_data[$key]['Result.Messages']);
        }

        // Output the JSON data
        return $converted_data;
    }


    function get_sendout_estimate($mc_token = '', $output_payload = []) {
        $data = [];
        global $sub_domain;
        $contact_keys = array_column($output_payload, 'subscriber_key');
    
        try {
            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $mc_token,
                'x-direct-pipe: true'
            ];

            $columns = [
                'TransactionTime', 
                'ContactKey',
                'Result.Messages'
            ];
    
            $body = [
                'contactKeys'   => $contact_keys,
                'activityTypes' => ['emailv2'],
                'statuses'      => ['Failed']
            ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $sub_domain . '.rest.marketingcloudapis.com/interaction/v1/interactions/journeyhistory/estimate?columns='.implode(',', $columns));
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
                $data['data'] = json_decode($response, true);
            }

            curl_close($curl);
            
        } catch (\Throwable $th) {
            $data['status'] = 'Failed';
            $data['message'] = $th->getMessage();
        }

        return $data;
    }

    function get_failed_sendout_download($mc_token = '', $journey_builder_id = '', $output_payload = []) {
        $data = [];
        global $sub_domain;
        $contact_keys = array_column($output_payload, 'subscriber_key');
    
        try {
            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $mc_token,
                'x-direct-pipe: true'
            ];

            $columns = [
                'TransactionTime', 
                'ContactKey',
                'Result.Messages'
            ];
    
            $body = [
                // 'definitionIds' => [$journey_builder_id],
                'contactKeys'   => $contact_keys,
                'activityTypes' => ['emailv2'],
                'statuses'      => ['Failed']
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
                $data['data'] = convert_text_to_json($response, $output_payload);
            }

            curl_close($curl);
            
        } catch (\Throwable $th) {
            $data['status'] = 'Failed';
            $data['message'] = $th->getMessage();
        }

        return $data;
    }

    function get_total_execution_time($start_datetime = '', $end_datetime = '') {
        // Create DateTime objects from the datetime strings
        $start_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $start_datetime);
        $end_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $end_datetime);

        // Calculate the difference between the datetimes
        $interval = $start_datetime->diff($end_datetime);

        // Get the difference in hours, minutes, and seconds
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;

        // Format the difference
        $differenceFormatted = '';
        if ($hours > 0) {
            $differenceFormatted .= $hours . 'h ';
        }
        if ($minutes > 0) {
            $differenceFormatted .= $minutes . 'm ';
        }
        if ($seconds > 0) {
            $differenceFormatted .= $seconds . 's';
        }
        return $differenceFormatted;
    }


    function get_data_from_failed_sendout($payload_data = [], $subscriber_key = '') {
        foreach ($payload_data as $key => $data) {
            if ($data['subscriber_key'] == $subscriber_key) {
                return [
                    'index' => $key,
                    'subscriber_key' => $data['subscriber_key'],
                    'message' => $data['Message'],
                    'data' => $data
                ];
            }
        }
        return null; // If subscriber_key not found
    }


    // ***** API EVENT *****
    $output = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $headers = validate_headers();
        if ($headers['status'] != 'Success') {
            $output = $headers;
        }
        else {
            $journey_builder_id = $headers['data']['journey_builder_id'];
            $event_definition_key = $headers['data']['event_definition_key'];

            $auth = authenticate();
            if ($auth['status'] != 'Success') {
                $output = $auth;
            }
            else {
                $mc_token = $auth['token'];
    
                $validate = validate_payload();
                if ($validate['status'] != 'Success') {
                    $output = $validate;   
                }
                else {
                    $data = $validate;
                    $output = process($mc_token, $journey_builder_id, $event_definition_key, $data);
    
                    $output_payload = $output['payload'];
                    
                    // Get failed sendout estimate
                    // sleep(5);
                    // $retry_count = 1;
                    // $failed_sendout_estimate = get_sendout_estimate($mc_token, $output_payload);
                    // while ($failed_sendout_estimate['data']['rowCount'] != $output['data']['successful_records'] && $retry_count != 10) {
                    //     $failed_sendout_estimate = get_sendout_estimate($mc_token, $output_payload);

                    //     $retry_count++;
                    //     sleep(1);
                    // }
                    // $output['failed_sendout_estimate'] = $failed_sendout_estimate['data'];

                    $failed_sendout = get_failed_sendout_download($mc_token, $journey_builder_id, $output_payload);
                    if (isset($failed_sendout['data']) && count($failed_sendout['data']) > 0) {
                        $output['failed_sendout'] = $failed_sendout['data'];
                    }
                }
            }
        }
    } 
    else {
        $output['status'] = 'Failed';
        $output['message'] = 'Invalid request';
    }   

    // unset($output['payload']);
    $end_datetime = get_current_datetime();
    $output['execution'] = [
        'started'  => $start_datetime,
        'finished' => $end_datetime,
        'duration' => get_total_execution_time($start_datetime, $end_datetime)
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output);
    // ***** / API EVENT *****
    
    
?>