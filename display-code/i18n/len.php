$english = "cheese";
$greek = "τυρί";

print "strlen() says " . strlen($english) . " for $english and " .
    strlen($greek) . " for $greek.\n";

print "mb_strlen() says " . mb_strlen($english) . " for $english and " .
    mb_strlen($greek) . " for $greek.\n";