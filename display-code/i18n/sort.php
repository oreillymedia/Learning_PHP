// US English
$en = new Collator('en_US');
// Danish
$da = new Collator('da_DK');

$words = array('absent','åben','zero');

print "Before sorting: " . implode(', ', $words) . "\n";

$en->sort($words);
print "en_US sorting: " . implode(', ', $words) . "\n";

$da->sort($words);
print "da_DK sorting: " . implode(', ', $words) . "\n";