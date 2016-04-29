$fh = fopen('people.txt','rb');
if (! $fh) {
    print "Error opening people.txt: $php_errormsg";
} else {
    while (! feof($fh)) {
        $line = fgets($fh);
        if ($line !== false) {
            $line = trim($line);
            $info = explode('|', $line);
            print '<li><a href="mailto:' . $info[0] . '">' . $info[1] ."</li>\n";
        }
    }
    if (! fclose($fh)) {
        print "Error closing people.txt: $php_errormsg";
    }
}