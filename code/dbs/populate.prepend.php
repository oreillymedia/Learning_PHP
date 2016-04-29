<?php
include __DIR__ . '/full-populate.prepend.php';
$_->exec('DELETE FROM dishes WHERE dish_id >= 5');
unset($_);
