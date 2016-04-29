$msg = "The cost is {0,number,currency}.";

$fmtUS = new MessageFormatter('en_US', $msg);
$fmtGB = new MessageFormatter('en_GB', $msg);

print $fmtUS->format(array(4.21)) . "\n";
print $fmtGB->format(array(4.21)) . "\n";