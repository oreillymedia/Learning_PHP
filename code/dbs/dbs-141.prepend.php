<?php 

try {
    $_ = new PDO('sqlite:/tmp/restaurant.db');
    $_->exec("DROP TABLE dishes");
} catch (Exception $e) {}

unset($_);
