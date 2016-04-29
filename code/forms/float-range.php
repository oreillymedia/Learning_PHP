<?php

$input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
if (is_null($input['price']) || ($input['price'] === false) ||
    ($input['price'] < 10.00) || ($input['price'] > 50.00)) {
    $errors[] = 'Please enter a valid price between $10 and $50.';
}
