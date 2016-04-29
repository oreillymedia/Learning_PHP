<?php
$comments = htmlentities($_POST['comments']);
// Now it's OK to print $comments
print $comments;