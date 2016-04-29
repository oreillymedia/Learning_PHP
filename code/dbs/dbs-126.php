<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=restaurant','penguin','top^hat');
    // Do some stuff with $db here
} catch (PDOException $e) {
    print "Couldn't connect to the database: " . $e->getMessage();
}
