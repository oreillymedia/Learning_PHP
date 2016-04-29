<?php
$dinner = 'Curry Cuttlefish';

function macrobiotic_dinner( ) {
    $dinner = "Some Vegetables";
    print "Dinner is $dinner";
    // Succumb to the delights of the ocean
    print " but I'd rather have ";
    print $GLOBALS['dinner'];
    print "\n";
}

macrobiotic_dinner( );
print "Regular dinner is: $dinner";