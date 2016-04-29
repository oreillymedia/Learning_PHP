<?php 

// Formats we want to support
$formats = array('application/json','text/html','text/plain');
// Response format if not specified
$default_format = 'application/json';

// Was a response format supplied?
if (isset($_SERVER['HTTP_ACCEPT'])) {
    // If a supported format is supplied, use it
    if (in_array($_SERVER['HTTP_ACCEPT'], $formats)) {
        $format = $_SERVER['HTTP_ACCEPT'];
    }
    // An unsupported format was supplied, so return an error
    else {
        // 406 means "You want a response in a format I can't generate"
        http_response_code(406);
        // Exiting now means no response body, which is OK
        exit();
    }
} else {
    $format = $default_format;
}

// Figure out what time it is
$response_data = array('now' => time());
// Tell the client what kind of content we're sending
header("Content-Type: $format");
// Print the time in a format-appropriate way
if ($format == 'application/json') {
    print json_encode($response_data);
}
else if ($format == 'text/html') { ?>
<!doctype html>
  <html>
    <head><title>Clock</title></head>
    <body><time><?= date('c', $response_data['now']) ?></time></body>
  </html>
<?php 
} else if ($format == 'text/plain') {
    print $response_data['now'];
}