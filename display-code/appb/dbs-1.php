try {
    // Connect
    $db = new PDO('sqlite:/tmp/restaurant.db');
    // Set up exceptions on DB errors
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $db->query('SELECT * FROM dishes ORDER BY price');
    $dishes = $stmt->fetchAll();
    if (count($dishes) == 0) {
        $html = '<p>No dishes to display</p>';
    } else {
        $html = "<table>\n";
        $html .= "<tr><th>Dish Name</th><th>Price</th><th>Spicy?</th></tr>\n";
        foreach ($dishes as $dish) {
            $html .= '<tr><td>' .
                  htmlentities($dish['dish_name']) . '</td><td>$' .
                  sprintf('%.02f', $dish['price']) . '</td><td>' .
                  ($dish['is_spicy'] ? 'Yes' : 'No') . "</td></tr>\n";
        }
        $html .= "</table>";
    }
} catch (PDOException $e) {
    $html = "Can't show dishes: " . $e->getMessage();
}
print $html;