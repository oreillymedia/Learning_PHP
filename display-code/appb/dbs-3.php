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
    global $db;

    // Set up the $form object with proper defaults
    $form = new FormHelper();

    // Retrieve the list of dish names to use from the database
    $sql = 'SELECT dish_id, dish_name FROM dishes ORDER BY dish_name';
    $stmt = $db->query($sql);
    $dishes = array();
    while ($row = $stmt->fetch()) {
        $dishes[$row->dish_id] = $row->dish_name;
    }

    // All the HTML and form display is in a separate file for clarity
    include 'dish-form.php';
}

function validate_form() {
    $input = array();
    $errors = array( );

    // As long as some dish_id value is submitted, we'll consider it OK.
    // If it doesn't match any dishes in the database, process_form()
    // can report that.
    if (isset($_POST['dish_id'])) {
        $input['dish_id'] = $_POST['dish_id'];
    } else {
        $errors[] = 'Please select a dish.';
    }
    return array($errors, $input);
}

function process_form($input) {
    // Access the global variable $db inside this function
    global $db;

    // build up the query
    $sql = 'SELECT dish_id, dish_name, price, is_spicy FROM dishes WHERE
            dish_id = ?';

    // Send the query to the database program and get all the rows back
    $stmt = $db->prepare($sql);
    $stmt->execute(array($input['dish_id']));
    $dish = $stmt->fetch();

    if (count($dish) == 0) {
        print 'No dishes matched.';
    } else {
        print '<table>';
        print '<tr><th>ID</th><th>Dish Name</th><th>Price</th>';
        print '<th>Spicy?</th></tr>';
        if ($dish->is_spicy == 1) {
            $spicy = 'Yes';
        } else {
            $spicy = 'No';
        }
        printf('<tr><td>%d</td><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
               $dish->dish_id,
               htmlentities($dish->dish_name), $dish->price, $spicy);
        print '</table>';
    }
}
?>