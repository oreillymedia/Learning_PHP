<?php

$q = $db->query('SELECT dish_name, price FROM dishes');
// $rows will be a four element array, each element is
// one row of data from the database.
$rows = $q->fetchAll();
