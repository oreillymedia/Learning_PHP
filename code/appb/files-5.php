<?php
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
            } else if (strcasecmp(substr($full, -5), '.html') != 0) {
                $errors[] = 'File name must end in .html';
            } else {
                // If it's OK, put the full path in $input so we can use
                // it in process_form();
                $input['full'] = $full;
            }
        }
    }

    return array($errors, $input);
}
