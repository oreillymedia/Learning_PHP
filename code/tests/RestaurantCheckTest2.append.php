<?php
$cmd = __DIR__ . '/../vendor/bin/phpunit RestaurantCheckTest2';
$out = `$cmd`;
$out = preg_replace("/Time: \d+ ms, Memory: \d+\.\d+Mb/","Time: 129 ms, Memory: 13.50Mb", $out);
$out = preg_replace("/\/Users.+\/RestaurantCheckTest2.php/","RestaurantCheckTest.php", $out);
print $out;