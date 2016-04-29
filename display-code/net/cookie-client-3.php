// Retrieve the cookie server page
$c = curl_init('http://php7.example.com/cookie-server.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// Save cookies to a 'saved.cookies' file in the same directory
// as this program
curl_setopt($c, CURLOPT_COOKIEJAR, __DIR__ . '/saved.cookies');
// Load cookies (if any have been previously saved) from the
// 'saved.cookies' file in this directory
curl_setopt($c, CURLOPT_COOKIEFILE, __DIR__ . '/saved.cookies');

// This request includes cookies from the file (if any)
$res = curl_exec($c);
print $res;