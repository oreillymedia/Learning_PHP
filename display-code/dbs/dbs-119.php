$q = $db->query('SELECT dish_name, price FROM dishes');
while ($row = $q->fetch()) {
    print "$row[dish_name], $row[price] \n";
}