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

// Choices for the "spicy" menu in the form
$spicy_choices = array('no','yes','either');

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
    // Set our own defaults
    $defaults = array('min_price' => '5.00',
                      'max_price' => '25.00');

    // Set up the $form object with proper defaults
    $form = new FormHelper($defaults);

    // All the HTML and form display is in a separate file for clarity
    include 'retrieve-form.php';
}

function validate_form() {
    $input = array();
    $errors = array( );

    // Remove any leading/trailing whitespace from submitted dish name
    $input['dish_name'] = trim($_POST['dish_name'] ?? '');

    // minimum price must be a valid floating point number
    $input['min_price'] = filter_input(INPUT_POST,'min_price', FILTER_VALIDATE_FLOAT);
    if ($input['min_price'] === null || $input['min_price'] === false) {
        $errors[] = 'Please enter a valid minimum price.';
    }

    // maximum price must be a valid floating point number
    $input['max_price'] = filter_input(INPUT_POST,'max_price', FILTER_VALIDATE_FLOAT);
    if ($input['max_price'] === null || $input['max_price'] === false) {
        $errors[] = 'Please enter a valid maximum price.';
    }

    // minimum price must be less than the maximum price
    if ($input['min_price'] >= $input['max_price']) {
        $errors[] = 'The minimum price must be less than the maximum price.';
    }

    $input['is_spicy'] = $_POST['is_spicy'] ?? '';
    if (! array_key_exists($input['is_spicy'], $GLOBALS['spicy_choices'])) {
        $errors[] = 'Please choose a valid "spicy" option.';
    }
    return array($errors, $input);
}

function process_form($input) {
    // Access the global variable $db inside this function
    global $db;

    // build up the query
    $sql = 'SELECT dish_name, price, is_spicy FROM dishes WHERE
            price >= ? AND price <= ?';

    // if a dish name was submitted, add to the WHERE clause
    // we use quote( ) and strtr( ) to prevent user-entered wildcards from working
    if (strlen($input['dish_name'])) {
        $dish = $db->quote($input['dish_name']);
        $dish = strtr($dish, array('_' => '\_', '%' => '\%'));
        $sql .= " AND dish_name LIKE $dish";
    }

    // if is_spicy is "yes" or "no", add appropriate SQL
    // (if it's "either", we don't need to add is_spicy to the WHERE clause)
    $spicy_choice = $GLOBALS['spicy_choices'][ $input['is_spicy'] ];
    if ($spicy_choice == 'yes') {
        $sql .= ' AND is_spicy = 1';
    } elseif ($spicy_choice == 'no') {
        $sql .= ' AND is_spicy = 0';
    }

    // Send the query to the database program and get all the rows back
    $stmt = $db->prepare($sql);
    $stmt->execute(array($input['min_price'], $input['max_price']));
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
    }
}
?>
