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

// Set up fetch mode: rows as objects
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

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
    include 'price-form.php';
}

function validate_form() {
    $input = array();
    $errors = array( );

    // minimum price must be a valid floating point number
    $input['min_price'] = filter_input(INPUT_POST,'min_price', FILTER_VALIDATE_FLOAT);
    if ($input['min_price'] === null || $input['min_price'] === false) {
        $errors[] = 'Please enter a valid minimum price.';
    }
    return array($errors, $input);
}

function process_form($input) {
    // Access the global variable $db inside this function
    global $db;

    // build up the query
    $sql = 'SELECT dish_name, price, is_spicy FROM dishes WHERE
            price >= ?';

    // Send the query to the database program and get all the rows back
    $stmt = $db->prepare($sql);
    $stmt->execute(array($input['min_price']));
    $dishes = $stmt->fetchAll();

    if (count($dishes) == 0) {
        print 'No dishes matched.';
    } else {
        print '<table>';
        print '<tr><th>Dish Name</th><th>Price</th><th>Spicy?</th></tr>';
        foreach ($dishes as $dish) {
            if ($dish->is_spicy == 1) {
                $spicy = 'Yes';
            } else {
                $spicy = 'No';
            }
            printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
                   htmlentities($dish->dish_name), $dish->price, $spicy);
        }
        print '</table>';
    }
}
?>