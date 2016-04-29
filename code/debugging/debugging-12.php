<?php
$name = 'Umberto';
function say_hello( ) {
    print 'Hello, ';
    print global $name;
}
say_hello( );
?>