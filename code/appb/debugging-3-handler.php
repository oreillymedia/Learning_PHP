<?php

function exceptionHandler($ex) {
    // Log the specifics to the error log
    error_log("ERROR: " . $ex->getMessage());
    // Print something less specific for users to see
    // and exit
    die("<p>Sorry, something went wrong.</p>");
}
set_exception_handler('exceptionHandler');
