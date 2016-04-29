<?php
try {
    $db = new PDO('sqlite:/tmp/restaurant.db');
} catch (Exception $e) {
    print "Couldn't connect to database: " . $e->getMessage();
    exit();
}

// Open dishes.txt for writing
$fh = fopen('dishes.txt','wb');

$q = $db->query("SELECT dish_name, price FROM dishes");
while($row = $q->fetch()) {
    // Write each line (with a newline on the end) to
    // dishes.txt
    fwrite($fh, "The price of $row[0] is $row[1] \n");
}
fclose($fh);
