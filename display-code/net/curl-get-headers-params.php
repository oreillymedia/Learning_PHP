// Just key and query term, no format specified in query string
$params = array('api_key' => NDB_API_KEY,
                'q' => 'black pepper');
$url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);

$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
print curl_exec($c);