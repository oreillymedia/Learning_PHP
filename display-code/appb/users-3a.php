<?php
// Start sessions first thing so we can use $_SESSION freely later.
session_start();

// Load the form helper class
require 'FormHelper.php';

$colors = array('ff0000' => 'Red',
                'ffa500' => 'Orange',
                'ffffff' => 'Yellow',
                '008000' => 'Green',
                '0000ff' => 'Blue',
                '4b0082' => 'Indigo',
                '663399' => 'Rebecca Purple');

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
    global $colors;

    // Set up the $form object with proper defaults
    $form = new FormHelper();
    // All the HTML and form display is in a separate file for clarity
    include 'color-form.php';
}

function validate_form() {
    $input = array();
    $errors = array( );

    // Color must be a valid color
    $input['color'] = $_POST['color'] ?? '';
    if (! array_key_exists($input['color'], $GLOBALS['colors'])) {
        $errors[] = 'Please select a valid color.';
    }

    return array($errors, $input);
}

function process_form($input) {
    global $colors;

    $_SESSION['background_color'] = $input['color'];
    print '<p>Your color has been set.</p>';
}
?>