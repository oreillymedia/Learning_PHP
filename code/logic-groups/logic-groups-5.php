<?php
$my_color = '#000000';

// This is incorrect: the default value can't be a variable.
function page_header_bad($color = $my_color) {
    print '<html><head><title>Welcome to my site</title></head>';
    print '<body bgcolor="#' . $color . '">';
}