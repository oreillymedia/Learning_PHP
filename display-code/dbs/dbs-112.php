// Decrease the price of some some dishes
$count = $db->exec("UPDATE dishes SET price = price + 5 WHERE price > 3");
print 'Changed the price of ' . $count . ' rows.';