// ZIP code to lookup weather for
if (isset($_SERVER['argv'][1])) {
    $zip = $_SERVER['argv'][1];
} else {
    print "Please specify a ZIP code.\n";
    exit();
}

// YQL query to find the weather
// See https://developer.yahoo.com/weather/ for more info
$yql = 'select item.condition from weather.forecast where woeid in ' .
       '(select woeid from geo.places(1) where text="'.$zip.'")';

// The params that the Yahoo! YQL query endpoint expects
$params = array("q" => $yql,
                "format" => "json",
                "env" => "store://datatables.org/alltableswithkeys");

// Build the YQL url, appending the query parameters
$url = "https://query.yahooapis.com/v1/public/yql?" . http_build_query($params);
// Make the request
$response = file_get_contents($url);
// Decode the response as JSON
$json = json_decode($response);
// Select the object in the nested JSON response that contains the info
$conditions = $json->query->results->channel->item->condition;
// Print out the weather
print "At {$conditions->date} it is {$conditions->temp} degrees " .
      "and {$conditions->text} in $zip\n";