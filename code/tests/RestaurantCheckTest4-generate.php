<?php

$before = trim(file_get_contents('RestaurantCheckTest3.php'));
$insert = file_get_contents('RestaurantCheckTest4-frag.php');

$before = trim($before,'}') . $insert . '}';

file_put_contents('RestaurantCheckTest4.php', $before);
