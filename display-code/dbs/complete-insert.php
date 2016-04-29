<?php

// Load the form helper class
require 'FormHelper.php';

// Connect to the database
try {
    $db = new PDO('sqlite:/tmp/restaurant.db');
} catch (PDOException $e) {
    print "Can't connect: " . $e->getMessage();
    exit();
}
// Set up exceptions on DB errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    // Set our own defaults: price is $5
    $defaults = array('price' => '5.00');

    // Set up the $form object with proper defaults
    $form = new FormHelper($defaults);

    // All the HTML and form display is in a separate file for clarity
    include 'insert-form.php';
}

function validate_form() {
    $input = array();
    $errors = array();

    // dish_name is required
    $input['dish_name'] = trim($_POST['dish_name'] ?? '');
    if (! strlen($input['dish_name'])) {
        $errors[] = 'Please enter the name of the dish.';
    }

    // price must be a valid floating point number and
    // more than 0
    $input['price'] = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    if ($input['price'] <= 0) {
        $errors[] = 'Please enter a valid price.';
    }

    // is_spicy defaults to 'no'
    $input['is_spicy'] = $_POST['is_spicy'] ?? 'no';

    return array($errors, $input);
}

function process_form($input) {
    // Access the global variable $db inside this function
    global $db;

    // Set the value of $is_spicy based on the checkbox
    if ($input['is_spicy'] == 'yes') {
        $is_spicy = 1;
    } else {
        $is_spicy = 0;
    }

    // Insert the new dish into the table
    try {
        $stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy)
                              VALUES (?,?,?)');
        $stmt->execute(array($input['dish_name'], $input['price'],$is_spicy));
        // Tell the user that we added a dish.
        print 'Added ' . htmlentities($input['dish_name']) . ' to the database.';
    } catch (PDOException $e) {
        print "Couldn't add your dish to the database.";
    }
}

?>