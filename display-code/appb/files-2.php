// The array to accumulate address counts
$addresses = array();

$fh = fopen('addresses.txt','rb');
if (! $fh) {
    die("Can't open addresses.txt: $php_errormsg");
}
while ((! feof($fh)) && ($line = fgets($fh))) {
    $line = trim($line);
    // Use the address as the key in $addresses. The value is the number
    // of times the address has appeared
    if (! isset($addresses[$line])) {
        $addresses[$line] = 0;
    }
    $addresses[$line] = $addresses[$line] + 1;
}
if (! fclose($fh)) {
    die("Can't close addresses.txt: $php_errormsg");
}

// Reverse sort (biggest first) $addresses by element value
arsort($addresses);

$fh = fopen('addresses-count.txt','wb');
if (! $fh) {
    die("Can't open addresses-count.txt: $php_errormsg");
}
foreach ($addresses as $address => $count) {
    // Don't forget the newline at the end.
    if (fwrite($fh, "$count,$address\n") === false) {
        die("Can't write $count,$address: $php_errormsg");
    }
}
if (! fclose($fh)) {
    die("Can't close addresses-count.txt: $php_errormsg");
}