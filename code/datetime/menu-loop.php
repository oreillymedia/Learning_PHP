<?php
$daysToPrint = 4;
$d = new DateTime('next Tuesday');
print "<select name='day'>\n";
for ($i = 0; $i < $daysToPrint; $i++) {
    print "  <option>" . $d->format('l F jS') . "</option>\n";
    // Add 2 days to the date
    $d->modify("+2 day");
}
print "</select>";
