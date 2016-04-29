<?php
function validate_form( ) {
    $input = array();
    $errors = array();

    // Sample users with hashed passwords
    $users = array('alice' =>
        '$2y$10$N47IXmT8C.sKUFXs1EBS9uJRuVV8bWxwqubcvNqYP9vcFmlSWEAbq',
                   'bob' =>
        '$2y$10$qCczYRc7S0llVRESMqUkGeWQT4V4OQ2qkSyhnxO0c.fk.LulKwUwW',
                   'charlie' =>
        '$2y$10$nKfkdviOBONrzZkRq5pAgOCbaTFiFI6O2xFka9yzXpEBRAXMW5mYi');

     // Make sure user name is valid
    if (! array_key_exists($_POST['username'], $users)) {
        $errors[  ] = 'Please enter a valid username and password.';
    }
    else {
        // See if password is correct
        $saved_password = $users[ $input['username'] ];
        $submitted_password = $_POST['password'] ?? '';
        if (! password_verify($submitted_password, $saved_password)) {
            $errors[  ] = 'Please enter a valid username and password.';
        }
    }

    return array($errors, $input);
}
