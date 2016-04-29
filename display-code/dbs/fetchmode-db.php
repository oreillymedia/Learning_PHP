// No need to call setFetchMode() or pass anything to fetch(),
// setAttribute() takes care of it
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NUM);

$q = $db->query('SELECT dish_name, price FROM dishes');
while ($row = $q->fetch()) {
    print implode(', ', $row) . "\n";
}

$anotherQuery = $db->query('SELECT dish_name FROM dishes WHERE price < 5');
// Each sub-array in $moreDishes is numerically indexed, too.
$moreDishes = $anotherQuery->fetchAll();