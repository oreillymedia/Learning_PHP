<?php
$_ = new PDO('sqlite:/tmp/restaurant.db');
$_->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
    $_->exec('DROP TABLE dishes');
} catch (Exception $e) {
}
$_->exec(file_get_contents(__DIR__ . '/dbs-134.sql'));
foreach (file(__DIR__ . '/dbs-15.sql') as $sql) {
    $_->exec(trim($sql));
}
