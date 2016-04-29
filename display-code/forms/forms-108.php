$input['order'] = $_POST['order'];
if (! array_key_exists($input['order'], $GLOBALS['sweets'])) {
    $errors[] = 'Please choose a valid order.';
}