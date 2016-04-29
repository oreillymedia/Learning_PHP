// Create a instance and assign it to $soup
$soup = new Entree;
// Set $soup's properties
$soup->name = 'Chicken Soup';
$soup->ingredients = array('chicken', 'water');

// Create a separate instance and assign it to $sandwich
$sandwich = new Entree;
// Set $sandwich's properties
$sandwich->name = 'Chicken Sandwich';
$sandwich->ingredients = array('chicken', 'bread');


foreach (['chicken','lemon','bread','water'] as $ing) {
    if ($soup->hasIngredient($ing)) {
        print "Soup contains $ing.\n";
    }
    if ($sandwich->hasIngredient($ing)) {
        print "Sandwich contains $ing.\n";
    }
}