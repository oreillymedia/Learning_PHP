$params = array('api_key' => NDB_API_KEY,
                'q' => 'black pepper',
                'format' => 'json');

$url = "http://api.nal.usda.gov/ndb/search?" . http_build_query($params);
$response = file_get_contents($url);
$info = json_decode($response);

foreach ($info->list->item as $item) {
    print "The ndbno for {$item->name} is {$item->ndbno}.\n";
}