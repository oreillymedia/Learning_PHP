<?php
function page_header( ) {
    print '<html><head><title>Welcome to my site</title></head>';
    print '<body bgcolor="#ffffff">';
}

page_header( );
print "Welcome, $user";
page_footer( );

function page_footer( ) {
    print '<hr>Thanks for visiting.';
    print '</body></html>';
}