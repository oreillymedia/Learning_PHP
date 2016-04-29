try {
    $db = new PDO('sqlite:/tmp/restaurant.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Eggplant with Chili Sauce is spicy
    // If we don't care how many rows are affected,
    // there's no need to keep the return value from exec()
    $db->exec("UPDATE dishes SET is_spicy = 1
                WHERE dish_name = 'Eggplant with Chili Sauce'");
    // Lobster with Chili Sauce is spicy and pricy
    $db->exec("UPDATE dishes SET is_spicy = 1, price=price * 2
               WHERE dish_name = 'Lobster with Chili Sauce'");
} catch (PDOException $e) {
    print "Couldn't insert a row: " . $e->getMessage();
}