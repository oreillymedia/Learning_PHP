$ok = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
if (is_null($ok) || ($ok === false)) {
    $errors[] = 'Please enter a valid price.';
}