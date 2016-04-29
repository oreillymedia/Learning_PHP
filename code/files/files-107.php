<?php
$log_file = '/var/log/users.log';
if (is_writeable($log_file)) {
    $fh = fopen($log_file,'ab');
    fwrite($fh, $_SESSION['username'] . ' at ' . strftime('%c') . "\n");
    fclose($fh);
} else {
    print "Cant write to log file.";
}