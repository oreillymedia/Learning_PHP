<?php
$stmt = $db->prepare('UPDATE dishes SET price = 1 WHERE dish_name LIKE ?');
$stmt->execute(array($_POST['dish_name']));