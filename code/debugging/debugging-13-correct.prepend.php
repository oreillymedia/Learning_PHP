<?php 
unlink('/tmp/restaurant.db');
$_ = new PDO('sqlite:/tmp/restaurant.db');
$_->exec(file_get_contents(__DIR__ . '/../dbs/dbs-134.sql'));
foreach (file(__DIR__ . '/../dbs//dbs-15.sql') as $sql) {
    $_->exec(trim($sql));
}
$_->exec('CREATE TABLE customers (customer_id INT PRIMARY KEY, customer_name TEXT, phone TEXT, favorite_dish_id INT)');

$customers = [
    ['Alice','1234',1],
    ['Bob','1-234-567-9876',3],
    ['Charlie','+1234',2],
    ['David','567-2323',5]
];

$stmt = $_->prepare('INSERT INTO customers (customer_id, customer_name, phone, favorite_dish_id) VALUES (NULL,?,?,?)');
foreach ($customers as $customer) {
    $stmt->execute($customer);
}
unset($_, $stmt, $customers);
