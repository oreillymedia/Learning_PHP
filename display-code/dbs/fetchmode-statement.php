$q = $db->query('SELECT dish_name, price FROM dishes');
// No need to pass anything to fetch(), setFetchMode()
// takes care of it
$q->setFetchMode(PDO::FETCH_NUM);
while($row = $q->fetch()) {
    print implode(', ', $row) . "\n";
}