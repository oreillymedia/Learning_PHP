if (! (isset($_GET['key']) && ($_GET['key'] == 'pineapple'))) {
    http_response_code(403);
    $response_data = array('error' => 'bad key');
}
else {
    $response_data = array('now' => time());
}
header('Content-Type: application/json');
print json_encode($response_data);