<?php

function niceExceptionHandler($ex) {
    // Tell the user something unthreatening
    print "Sorry! Something unexpected happened. Please try again later.";
    // Log more detailed information for a sysadmin to review
    error_log("{$ex->getMessage()} in {$ex->getFile()} @ {$ex->getLine()}");
    error_log($ex->getTraceAsString());
}

set_exception_handler('niceExceptionHandler');

print "I'm about to connect to a made up, pretend, broken database!\n";

// The DSN given to the PDO constructor does not specify a valid database
// or connection parameters, so the constructor will throw an exception
$db = new PDO('garbage:this is obviously not going to work!');

print "This is not going to get printed.";
