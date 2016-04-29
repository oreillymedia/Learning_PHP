<?php

// This assumes FormHelper.php is in the same directory as
// this file.
require 'FormHelper.php';

// setup the arrays of choices in the select menu
// this is needed in display_form( ), validate_form( ),
// and process_form( ), so it is declared in the global scope
$ops = array('+','-','*','/');

// The main page logic:
// - If the form is submitted, validate and then process or redisplay
// - If it's not submitted, display
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If validate_form( ) returns errors, pass them to show_form( )
    list($errors, $input) = validate_form();
    if ($errors) {
        show_form($errors);
    } else {
        // The submitted data is valid, so process it
        process_form($input);
        // And then show the form again to do another calculation
        show_form();
    }
} else {
    // The form wasn't submitted, so display
    show_form();
}

function show_form($errors = array()) {
    $defaults = array('num1' => 2,
                      'op' => 2, // the index of '*' in $ops
                      'num2' => 8);
    // Set up the $form object with proper defaults
    $form = new FormHelper($defaults);

    // All the HTML and form display is in a separate file for clarity
    include 'math-form.php';
}

function validate_form( ) {
    $input = array();
    $errors = array( );

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

function process_form($input) {
    $result = 0;
    if ($input['op'] == '+') {
        $result = $input['num1'] + $input['num2'];
    }
    else if ($input['op'] == '-') {
        $result = $input['num1'] - $input['num2'];
    }
    else if ($input['op'] == '*') {
        $result = $input['num1'] * $input['num2'];
    }
    else if ($input['op'] == '/') {
        $result = $input['num1'] / $input['num2'];
    }
    $message = "{$input['num1']} {$input['op']} {$input['num2']} = $result";

    print "<h3>$message</h3>";
}
?>
