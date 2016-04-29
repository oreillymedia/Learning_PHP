<?php
function validate_form( ) {
    global $db;
    $input = array();
    $errors = array();

    // This gets set to true only if the submitted password matches
    $password_ok = false;

    $input['username'] = $_POST['username'] ?? '';
    $submitted_password = $_POST['password'] ?? '';

    $stmt = $db->prepare('SELECT password FROM users WHERE username = ?');
    $stmt->execute($input['username']);
    $row = $stmt->fetch();
    // If there's no row, then the username didn't match any rows
    if ($row) {
        $password_ok = password_verify($submitted_password, $row[0]);
    }
    if (! $password_ok) {
        $errors[] = 'Please enter a valid username and password.';
    }

    return array($errors, $input);
}
