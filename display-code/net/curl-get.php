<?php

$c = curl_init('http://numbersapi.com/09/27');
// Tell cURL to return the response contents as a string
// rather then printing them out immediately
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// Execute the request
$fact = curl_exec($c);

?>
Did you know that <?= $fact ?>