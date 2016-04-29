<?php 

// Just key and query term, no format specified in query string
$params = array('api_key' => NDB_API_KEY,
                'q' => 'black pepper');
$url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);

// Options are to set a Content-Type request header
$options = array('header' => 'Content-Type: application/json');
// Create a context for an 'http' stream
$context = stream_context_create(array('http' => $options));

// Pass the context as the third argument to file_get_contents
print file_get_contents($url, false, $context);
