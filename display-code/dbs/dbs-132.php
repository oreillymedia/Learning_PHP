$stmt = $db->prepare('SELECT dish_name, price FROM dishes
                      WHERE dish_name LIKE ?');
$stmt->execute(array($_POST['dish_search']));
while ($row = $stmt->fetch()) {
    // ... do something with $row ...
}