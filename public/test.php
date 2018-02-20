<?php

$att_records = new stdClass();
$att_records->test = 'rawr';

$data_string = json_encode($att_records);
$post_url = "http://attendance.pmo.mv/import/records?key=W3gvdTh6ynfLWrNrUDh5VBEykNqQmFKsnpprDX4AynfLWrNr";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
$server_output = curl_exec($ch);
curl_close($ch);


echo $data_string;