<?php
// Use the SQLite database 'dinner.db'
$db = new PDO('sqlite:dinner.db');
// Define what the allowable meals are
$meals = array('breakfast','lunch','dinner');
// Check if submitted form parameter "meal" is one of
// "breakfast", "lunch", or "dinner"
if (in_array($_POST['meal'], $meals)) {
    // If so, get all of the dishes for the specified meal
    $stmt = $db->prepare('SELECT dish,price FROM meals WHERE meal LIKE ?');
    $stmt->execute(array($_POST['meal']));
    $rows = $stmt->fetchAll();
    // If no dishes were found in the database, say so
    if (count($rows) == 0) {
        print "No dishes available.";
    } else {
        // Print out each dish and its price as a row
        // in an HTML table
        print '<table><tr><th>Dish</th><th>Price</th></tr>';
        foreach ($rows as $row) {
            print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
        }
        print "</table>";
    }
} else {
    // This message prints if the submitted parameter "meal" isn't
    // "breakfast", "lunch", or "dinner"
    print "Unknown meal.";
}
?>
