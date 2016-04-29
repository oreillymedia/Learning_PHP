<?php

$fh = fopen('dishes.csv','rb');
if (! $fh) {
    die("Can't open dishes.csv: $php_errormsg");
}
print "<table>\n";
while ((! feof($fh)) && ($line = fgetcsv($fh))) {
    // Using implode() as in Chapter 4
    print "<tr><td>" . implode("</td><td>", $line) . "</td></tr>\n";
}
print "</table>";
