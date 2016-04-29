<?php
$hamburger = 4.95;
$shake = 1.95;
$cola = 0.85;

$tip_rate = 0.16;
$tax_rate = 0.075;

$food = (2 * $hamburger) + $shake + $cola;
$tip = $food * $tip_rate;
$tax = $food * $tax_rate;

$total = $food + $tip + $tax;

print 'The total cost of the meal is $' . $total;
