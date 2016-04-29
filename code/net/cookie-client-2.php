<?php 
// Retrieve the cookie server page, sending no cookies
$c = curl_init('http://php7.example.com:7000/cookie-server.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// Turn on the cookie jar
curl_setopt($c, CURLOPT_COOKIEJAR, true);

// The first time, there are no cookies
$res = curl_exec($c);
print $res;

// The second time, there are cookies from the first request
$res = curl_exec($c);
print $res;
