<?php

$a = file_get_contents('page.html');
$b = file_get_contents('files-100.out');
if ($a !== $b) {
    var_dump("generated",$a,"expected",$b);
}
