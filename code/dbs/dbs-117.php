<?php
$stmt = $db->prepare('INSERT INTO dishes (dish_name) VALUES (?)');
$stmt->execute(array($_POST['new_dish_name']));