<table>
<tr><th>City</th><th>Population</th></tr>
<?php
// Each element in $census is a three-element array
// containing city name, state, and population
$census = [ ['New York', 'NY', 8175133],
            ['Los Angeles', 'CA' , 3792621],
            ['Chicago', 'IL' , 2695598],
            ['Houston', 'TX' , 2100263],
            ['Philadelphia', 'PA' , 1526006],
            ['Phoenix', 'AZ' , 1445632],
            ['San Antonio', 'TX' , 1327407],
            ['San Diego', 'CA' , 1307402],
            ['Dallas', 'TX' , 1197816],
            ['San Jose', 'CA' , 945942] ];

$total = 0;
$state_totals = array();
foreach ($census as $city_info) {
    // Update the total population
    $total += $city_info[2];
    // If we haven't seen this state yet, initialize its
    // population total to 0
    if (! array_key_exists($city_info[1], $state_totals)) {
        $state_totals[$city_info[1]] = 0;
    }
    // Update the per-state population
    $state_totals[$city_info[1]] += $city_info[2];
    print "<tr><td>$city_info[0], $city_info[1]</td><td>$city_info[2]</td></tr>\n";
}
print "<tr><td>Total</td><td>$total</td></tr>\n";
// Print the per-state totals
foreach ($state_totals as $state => $population) {
    print "<tr><td>$state</td><td>$population</td></tr>\n";
}
print "</table>";