<?php

// With numeric indexes only, it's easy to join the values together
$q = $db->query('SELECT dish_name, price FROM dishes');
while ($row = $q->fetch(PDO::FETCH_NUM)) {
    print implode(', ', $row) . "\n";
}

// With an object, property access syntax gets you the values
$q = $db->query('SELECT dish_name, price FROM dishes');
while ($row = $q->fetch(PDO::FETCH_OBJ)) {
    print "{$row->dish_name} has price {$row->price} \n";
}
