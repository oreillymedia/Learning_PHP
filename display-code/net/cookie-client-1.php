// Retrieve the cookie server page, sending no cookies
$c = curl_init('http://php7.example.com/cookie-server.php');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
// The first time, there are no cookies
$res = curl_exec($c);
print $res;

// The second time, there are still no cookies
$res = curl_exec($c);
print $res;