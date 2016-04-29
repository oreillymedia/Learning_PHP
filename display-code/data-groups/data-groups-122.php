$specials = array( array('Chestnut Bun', 'Walnut Bun', 'Peanut Bun'),
                   array('Chestnut Salad','Walnut Salad', 'Peanut Salad') );

// $num_specials is 2: the number of elements in the first dimension of $specials
for ($i = 0, $num_specials = count($specials); $i < $num_specials; $i++) {
    // $num_sub is 3: the number of elements in each sub-array
    for ($m = 0, $num_sub = count($specials[$i]); $m < $num_sub; $m++) {
        print "Element [$i][$m] is " . $specials[$i][$m] . "\n";
    }
}