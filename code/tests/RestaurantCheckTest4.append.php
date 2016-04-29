<?php
$cmd = __DIR__ . '/../vendor/bin/phpunit RestaurantCheckTest4';
$out = `$cmd`;
$out = preg_replace("/Time: \d+ ms, Memory: \d+\.\d+Mb/","Time: 138 ms, Memory: 13.50Mb", $out);
$out = preg_replace("/\/Users.+\/RestaurantCheckTest4.php/","RestaurantCheckTest.php", $out);
print $out;