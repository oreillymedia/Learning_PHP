$meals = array('Walnut Bun' => 1,
               'Cashew Nuts and White Mushrooms' => 4.95,
               'Dried Mulberries' => 3.00,
               'Eggplant with Chili Sauce' => 6.50);

foreach ($meals as $dish => $price) {
    // $price = $price * 2 does NOT work
    $meals[$dish] = $meals[$dish] * 2;
}

// Iterate over the array again and print the changed values
foreach ($meals as $dish => $price) {
    printf("The new price of %s is \$%.2f.\n",$dish,$price);
}