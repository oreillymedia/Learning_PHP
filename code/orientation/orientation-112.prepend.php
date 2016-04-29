<?php
$_POST['meal'] = 'lunch';

$db = new PDO('sqlite:dinner.db');
$stmt = $db->prepare('SELECT dish,price FROM meals WHERE meal LIKE ?');
if ($stmt === false) {
    $db->exec('CREATE TABLE meals (dish text, price number, meal text)');
    $db->exec("INSERT INTO meals VALUES ('eggs',12,'lunch')");
}
unset($db);
unset($stmt);
