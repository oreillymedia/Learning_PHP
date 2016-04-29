<?php
foreach (range('a','k') as $_) {
    $z = ${$_};
    print $z->format('r') . "\n";
}
