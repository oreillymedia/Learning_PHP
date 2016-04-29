$url = 'http://php7.example.com/post-server.php';

// Two variables to send via POST
$form_data = array('name' => 'black pepper',
                   'smell' => 'good');

// Set the method, content type, and content
$options = array('method' => 'POST',
                 'header' => 'Content-Type: application/x-www-form-urlencoded',
                 'content' => http_build_query($form_data));
// Create a context for an 'http' stream
$context = stream_context_create(array('http' => $options));

// Pass the context as the third argument to file_get_contents
print file_get_contents($url, false, $context);