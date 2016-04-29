<?php
session_start( );

if (isset($_SESSION['count'])) {
    $_SESSION['count'] = $_SESSION['count'] + 1;
} else {
    $_SESSION['count'] = 1;
}
print "You've looked at this page " . $_SESSION['count'] . ' times.';
