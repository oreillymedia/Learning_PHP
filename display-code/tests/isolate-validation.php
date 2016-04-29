function validate_form($submitted) {
    $errors = array();
    $input = array();

    $input['age'] = filter_var($submitted['age'] ?? NULL, FILTER_VALIDATE_INT);
    if ($input['age'] === false) {
        $errors[] = 'Please enter a valid age.';
    }

    $input['price'] = filter_var($submitted['price'] ?? NULL,
                                 FILTER_VALIDATE_FLOAT);
    if ($input['price'] === false) {
        $errors[] = 'Please enter a valid price.';
    }

    $input['name'] = trim($submitted['name'] ?? '');
    if (strlen($input['name']) == 0) {
        $errors[] = "Your name is required.";
    }

    return array($errors, $input);
}