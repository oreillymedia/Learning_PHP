<?php
require 'FormHelper.php';
session_start( );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($errors, $input) = validate_form();
    if ($errors) {
        show_form($errors);
    } else {
        process_form($input);
    }
} else {
    show_form();
}

function show_form($errors = array()) {
    // No defaults of our own, no nothing to pass to the
    // FormHelper constructor
    $form = new FormHelper();

    // Build up the error HTML to use later
    if ($errors) {
        $errorHtml = '<ul><li>';
        $errorHtml .= implode('</li><li>',$errors);
        $errorHtml .= '</li></ul>';
    } else {
        $errorHtml = '';
    }


    // This form is small, so we'll just print out its components
    // here.
print <<<_FORM_
<form method="POST" action="{$form->encode($_SERVER['PHP_SELF'])}">
  $errorHtml
  Username: {$form->input('text', ['name' => 'username'])} <br/>
  Password: {$form->input('password', ['name' => 'password'])} <br/>
  {$form->input('submit', ['value' => 'Log In'])}
</form>
_FORM_;
}

function validate_form( ) {
    $input = array();
    $errors = array();

    // Some sample usernames and passwords
    $users = array('alice'   => 'dog123',
                   'bob'     => 'my^pwd',
                   'charlie' => '**fun**');

    // Make sure user name is valid
    $input['username'] = $_POST['username'] ?? '';
    if (! array_key_exists($input['username'], $users)) {
        $errors[] = 'Please enter a valid username and password.';
    }
    // The else clause means we avoid checking the password if an invalid
    // username is entered.
    else {
        // See if password is correct
        $saved_password = $users[ $input['username'] ];
        $submitted_password = $_POST['password'] ?? '';
        if ($saved_password != $submitted_password) {
            $errors[] = 'Please enter a valid username and password.';
        }
    }
    return array($errors, $input);
}


function process_form($input) {
    // Add the username to the session
    $_SESSION['username'] = $input['username'];

    print "Welcome, $_SESSION[username]";
}
?>