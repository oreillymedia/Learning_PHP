$db->exec("INSERT INTO dishes (dish_name)
           VALUES ('$_POST[new_dish_name]')");