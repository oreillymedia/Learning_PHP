$url = 'https://api.github.com/gists';
$data = ['public' => true,
         'description' => "This program a gist of itself.",
         // As the API docs say:
         // The keys in the files object are the string filename,
         // and the value is another object with a key of content,
         // and a value of the file contents.
         'files' => [ basename(__FILE__) =>
                      [ 'content' => file_get_contents(__FILE__) ] ] ];

$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($c, CURLOPT_USERAGENT, 'learning-php-7/exercise');

$response = curl_exec($c);
if ($response === false) {
    print "Couldn't make request.";
} else {
    $info = curl_getinfo($c);
    if ($info['http_code'] != 201) {
        print "Couldn't create gist, got {$info['http_code']}\n";
        print $response;
    } else {
        $body = json_decode($response);
        print "Created gist at {$body->html_url}\n";
    }
}