<?php

// The html_img2() function from the previous exercise is saved in this file
include "html-img2.php";

$image_path = '/images/';

print html_img2('puppy.png');
print html_img2('kitten.png','fuzzy');
print html_img2('dragon.png',null,640,480);
