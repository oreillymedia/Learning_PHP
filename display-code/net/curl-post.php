$url = 'http://php7.example.com/post-server.php';

// Two variables to send via POST
$form_data = array('name' => 'black pepper',
                   'smell' => 'good');

$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// This should be a POST request
curl_setopt($c, CURLOPT_POST, true);
// This is the data to send
curl_setopt($c, CURLOPT_POSTFIELDS, $form_data);

print curl_exec($c);