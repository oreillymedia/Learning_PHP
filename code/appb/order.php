<?php
session_start();

// This assumes FormHelper.php is in the same directory as
// this file.
require 'FormHelper.php';

// setup the array of choices in the select menu
// this is needed in display_form( ), validate_form( ),
// and process_form( ), so it is declared in the global scope
$products = [ 'cuke'    => 'Braised Sea Cucumber',
              'stomach' => "Sauteed Pig's Stomach",
              'tripe'   => 'Sauteed Tripe with Wine Sauce',
              'taro'    => 'Stewed Pork with Taro',
              'giblets' => 'Baked Giblets with Salt',
              'abalone' => 'Abalone with Marrow and Duck Feet'];

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
    }
} else {
    // The form wasn't submitted, so display
    show_form();
}

function show_form($errors = array()) {
    global $products;
    $defaults = array();
    // Start out with 0 as a default
    foreach ($products as $code => $label) {
        $defaults["quantity_$code"] = 0;
    }
    // If quantities are in the session, use those
    if (isset($_SESSION['quantities'])) {
        foreach ($_SESSION['quantities'] as $field => $quantity) {
            $defaults[$field] = $quantity;
        }
    }
    $form = new FormHelper($defaults);
    // All the HTML and form display is in a separate file for clarity
    include 'order-form.php';
}

function validate_form( ) {
    global $products;

    $input = array();
    $errors = array( );

    // For each quantity box, make sure the value is
    // is a valid integer >= 0.
    foreach ($products as $code => $name) {
        $field = "quantity_$code";
        $input[$field] = filter_input(INPUT_POST, $field,
                                      FILTER_VALIDATE_INT,
                                      ['options' => ['min_range'=>0]]);
        if (is_null($input[$field]) || ($input[$field] === false)) {
            $errors[] = "Please enter a valid quantity for $name.";
        }
    }

    return array($errors, $input);
}

function process_form($input) {
    $_SESSION['quantities'] = $input;

    print "Thank you for your order.";
}
