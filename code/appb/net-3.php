<?php

// Seconds from Jan 1, 1970 until now
$now = time();
setcookie('last_access', $now);
if (isset($_COOKIE['last_access'])) {
    // To create a DateTime from a seconds-since-1970 value,
    // prefix it with @.
    $d = new DateTime('@'. $_COOKIE['last_access']);
    $msg = '<p>You last visited this page at ' .
         $d->format('g:i a') . ' on ' .
         $d->format('F j, Y') . '</p>';
} else {
    $msg = '<p>This is your first visit to this page.</p>';
}

print $msg;
