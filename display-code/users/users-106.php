<?php
session_start( );

if (array_key_exists('username', $_SESSION)) {
    print "Hello, $_SESSION[username].";
} else {
    print 'Howdy, stranger.';
}
?>