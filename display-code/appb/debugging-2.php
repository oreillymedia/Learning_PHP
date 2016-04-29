function validate_form( ) {
    $input = array();
    $errors = array( );

    // turn on output buffering
    ob_start();
    // dump all the submitted data
    var_dump($_POST);
    // capture the generated "output"
    $output = ob_get_contents();
    // turn off output buffering
    ob_end_clean();
    // Send the variable dump to the error log
    error_log($output);

    // op is required
    $input['op'] = $GLOBALS['ops'][$_POST['op']] ?? '';
    if (! in_array($input['op'], $GLOBALS['ops'])) {
        $errors[] = 'Please select a valid operation.';
    }
    // num1 and num2 must be numbers
    $input['num1'] = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    if (is_null($input['num1']) || ($input['num1'] === false)) {
        $errors[] = 'Please enter a valid first number.';
    }

    $input['num2'] = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    if (is_null($input['num2']) || ($input['num2'] === false)) {
        $errors[] = 'Please enter a valid second number.';
    }

    // Can't divide by zero
    if (($input['op'] == '/') && ($input['num2'] == 0)) {
        $errors[] = 'Division by zero is not allowed.';
    }

    return array($errors, $input);
}