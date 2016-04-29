$response_data = array('now' => time());
header('Content-Type: application/json');
print json_encode($response_data);