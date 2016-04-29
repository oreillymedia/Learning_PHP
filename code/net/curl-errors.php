<?php 

// A pretend API endpoint that doesn't exist 
$c = curl_init('http://api.example.com');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($c);
// Get all the connect info, whether or not it succeeded
$info = curl_getinfo($c);

// Something went wrong with the connection
if ($result === false) {
    print "Error #" . curl_errno($c) . "\n";
    print "Uh-oh! cURL says: " . curl_error($c) . "\n";
}
// HTTP response codes in the 400s and 500s mean errors
else if ($info['http_code'] >= 400) {
    print "The server says HTTP error {$info['http_code']}.\n";
}
else {
    print "A successful result!\n";
}
// The request info includes timing statistics as well
print "By the way, this request took {$info['total_time']} seconds.\n";
