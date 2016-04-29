<?php 

// Use the value sent in the cookie, if any, or 0 if no cookie supplied.
$value = $_COOKIE['c'] ?? 0;
// Increment the value by 1
$value++;
// Set the new cookie in the response
setcookie('c', $value);
// Tell the user what cookies we saw
print "Cookies: " . count($_COOKIE) . "\n";
foreach ($_COOKIE as $k => $v) {
    print "$k: $v\n";
}
