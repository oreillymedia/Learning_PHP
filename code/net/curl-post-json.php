<?php 

$url = 'http://php7.example.com:7000/post-server.php';

// Two variables to send as JSON via POST
$form_data = array('name' => 'black pepper',
                   'smell' => 'good');

$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// This should be a POST request
curl_setopt($c, CURLOPT_POST, true);
// This is a request containing JSON
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
// This is the data to send, formatted appropriately
curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($form_data));

print curl_exec($c);
