<?php
$dinner = 'Curry Cuttlefish';

function vegetarian_dinner( ) {
    global $dinner;
    print "Dinner was $dinner, but now it's ";
    $dinner = 'Sauteed Pea Shoots';
    print $dinner;
    print "\n";
}

print "Regular Dinner is $dinner.\n";
vegetarian_dinner( );
print "Regular dinner is $dinner";