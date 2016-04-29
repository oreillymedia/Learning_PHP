<?php
$filename = realpath("/usr/local/data/$_POST[user]");

// Make sure that $filename is under /usr/local/data
if (('/usr/local/data/' == substr($filename, 0, 16)) &&
    is_readable($filename)) {
    print 'User profile for ' . htmlentities($_POST['user']) .': <br/>';
    print file_get_contents($filename);
} else {
    print "Invalid user entered.";
}
