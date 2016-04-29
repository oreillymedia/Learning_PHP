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

// Put the list of dish IDs and names in a global array since
// we'll need it in show_form() and validate_form
$dishes = array();
$sql = 'SELECT dish_id, dish_name FROM dishes ORDER BY dish_name';
$stmt = $db->query($sql);
while ($row = $stmt->fetch()) {
    $dishes[$row->dish_id] = $row->dish_name;
}

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
    global $db, $dishes;

    // Set up the $form object with proper defaults
    $form = new FormHelper();

    // All the HTML and form display is in a separate file for clarity
    include 'customer-form.php';
}

function validate_form() {
    global $dishes;
    $input = array();
    $errors = array();

    // Make sure a dish_id valid is submitted and in $dishes
    // As long as some dish_id value is submitted, we'll consider it OK.
    // If it doesn't match any dishes in the database, process_form()
    // can report that.
    $input['dish_id'] = $_POST['dish_id'] ?? '';
    if (! array_key_exists($input['dish_id'], $dishes)) {
        $errors[] = 'Please select a valid dish.';
    }

    // Name is required
    $input['name'] = trim($_POST['name'] ?? '');
    if (0 == strlen($input['name'])) {
        $errors[] = 'Please enter a name.';
    }

    // Phone number is required
    $input['phone'] = trim($_POST['phone'] ?? '');
    if (0 == strlen($input['phone'])) {
        $errors[] = 'Please enter a phone number.';
    } else {
        // Be US-centric and ensure that phone number contains
        // at least ten digits. Using ctype_digit on each
        // character is not the most efficient way to do this,
        // but is logically straightforward and avoids
        // regular expressions
        $digits = 0;
        for ($i = 0; $i < strlen($input['phone']); $i++) {
            if (ctype_digit($input['phone'][$i])) {
                $digits++;
            }
        }
        if ($digits < 10) {
            $errors[] = 'Phone number needs at least ten digits.';
        }
    }

    return array($errors, $input);
}

function process_form($input) {
    // Access the global variable $db inside this function
    global $db;

    // build up the query. No need to specify customer_id because
    // the database will automatically assign a unique one
    $sql = 'INSERT INTO customers (name,phone,favorite_dish_id) ' .
           'VALUES (?,?,?)';

    // Send the query to the database program and get all the rows back
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute(array($input['name'],$input['phone'],$input['dish_id']));
        print '<p>Inserted new customer.</p>';
    } catch (Exception $e) {
        print "<p>Couldn't insert customer: {$e->getMessage()}.</p>";
    }
}
?>
