<?php

try {
    $drink = new Entree('Glass of Milk', 'milk');
    if ($drink->hasIngredient('milk')) {
        print "Yummy!";
    }
} catch (Exception $e) {
    print "Couldn't create the drink: " . $e->getMessage();
}
