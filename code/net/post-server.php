<?php
foreach ($_POST as $k => $v) {
    print "$k: $v\n";
}
// var_dump($_SERVER);
var_dump(file_get_contents('php://input'));
