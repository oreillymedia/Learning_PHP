<?php

// Some soup with name and ingredients
$soup = new Entree('Chicken Soup', array('chicken', 'water'));

// A sandwich with name and ingredients
$sandwich = new Entree('Chicken Sandwich', array('chicken', 'bread'));

// A combo meal
$combo = new ComboMeal('Soup + Sandwich', array($soup, $sandwich));

foreach (['chicken','water','pickles'] as $ing) {
    if ($combo->hasIngredient($ing)) {
        print "Something in the combo contains $ing.\n";
    }
}