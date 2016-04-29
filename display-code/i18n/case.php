$english = "Please stop shouting.";
$danish = "Venligst stoppe råben.";
$vietnamese = "Hãy dừng la hét.";

print "strtolower() says: \n";
print "   " . strtolower($english) . "\n";
print "   " . strtolower($danish) . "\n";
print "   " . strtolower($vietnamese) . "\n";

print "mb_strtolower() says: \n";
print "   " . mb_strtolower($english) . "\n";
print "   " . mb_strtolower($danish) . "\n";
print "   " . mb_strtolower($vietnamese) . "\n";

print "strtoupper() says: \n";
print "   " . strtoupper($english) . "\n";
print "   " . strtoupper($danish) . "\n";
print "   " . strtoupper($vietnamese) . "\n";

print "mb_strtoupper() says: \n";
print "   " . mb_strtoupper($english) . "\n";
print "   " . mb_strtoupper($danish) . "\n";
print "   " . mb_strtoupper($vietnamese) . "\n";