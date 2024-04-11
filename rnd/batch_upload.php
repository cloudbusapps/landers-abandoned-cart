<?php
    $payload = json_decode(file_get_contents('php://input'), true);

    $batchable = 2;
    if (isset($payload['data']) && is_array($payload['data'])) {
        $data = $payload['data'];
        $count = count($data);
        $temp = [];
        $batch_count = 1;
        $temp_count = 1;
        foreach($data as $key => $value) {
            if ($temp_count == $batchable || $key == count($data)-1) {
                $temp['data'][] = $value;
                $temp['batch'] = $batch_count;

                $jsonData = json_encode($temp, JSON_PRETTY_PRINT);
                file_put_contents("batches/batch_$batch_count.json", $jsonData);

                $temp = [];
                $batch_count++;
                $temp_count = 1;
            } 
            else {
                $temp['data'][] = $value;
                $temp_count++;
            }

        }
        print_r($data);
    }