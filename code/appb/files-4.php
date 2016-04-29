<?php

// Load the form helper class
require 'FormHelper.php';

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
    // Set up the $form object with proper defaults
    $form = new FormHelper();

    // All the HTML and form display is in a separate file for clarity
    include 'filename-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    // Make sure a filename is specified
    $input['file'] = trim($_POST['file'] ?? '');
    if (0 == strlen($input['file'])) {
        $errors[] = 'Please enter a filename.';
    } else {
        // Make sure the full filename is underneath the web
        // server's document root
        $full = $_SERVER['DOCUMENT_ROOT'] . '/' . $input['file'];
        // Use realpath() to resolve any .. sequences or
        // symbolic links
        $full = realpath($full);
        if ($full === false) {
            $errors[] = "Please enter a valid filename.";
        } else {
            // Make sure $full begins with the document root directory
            $docroot_len = strlen($_SERVER['DOCUMENT_ROOT']);
            if (substr($full, 0, $docroot_len) != $_SERVER['DOCUMENT_ROOT']) {
                $errors[] = 'File must be under document root.';
            } else {
                // If it's OK, put the full path in $input so we can use
                // it in process_form();
                $input['full'] = $full;
            }
        }
    }

    return array($errors, $input);
}

    function process_form($input) {
    if (is_readable($input['full'])) {
        print htmlentities(file_get_contents($input['full']));
    } else {
        print "Can't read {$input['file']}.";
    }
}
?>
