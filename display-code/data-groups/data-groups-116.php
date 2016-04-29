$meal = array('breakfast' => 'Walnut Bun',
              'lunch' => 'Cashew Nuts and White Mushrooms',
              'snack' => 'Dried Mulberries',
              'dinner' => 'Eggplant with Chili Sauce');

print "Before Sorting:\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value\n";
}

arsort($meal);

print "After Sorting:\n";
foreach ($meal as $key => $value) {
    print "   \$meal: $key $value\n";
}