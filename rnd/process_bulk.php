<?php
    include_once('process_batch.php');

    $payload = json_decode(file_get_contents('php://input'), true);

    $batchable = 50;
    if (isset($payload['data']) && is_array($payload['data'])) {
        $output = [];
        $data = $payload['data'];
        $batches = array_chunk($data, $batchable);
        foreach ($batches as $i => $batch) {
            $batch_payload = [
                'label' => $payload['label'],
                'event_definition_key' => $payload['event_definition_key'],
                'journey_builder_id' => $payload['journey_builder_id'],
                'data' => $batch
            ];

            $output['batch_'.($i+1)] = api_event($batch_payload);
        }

        header('Content-Type: application/json');
        echo json_encode($output);
    }