<?php
// This makes $vegetables an array
$vegetables['corn'] = 'yellow';

// This removes any trace of "corn" and "yellow" and makes $vegetables a scalar
$vegetables = 'delicious';

// This makes $fruits a scalar
$fruits = 283;

// This doesn't work -- $fruits stays 283 and the PHP engine
// issues a Warning
$fruits['potassium'] = 'banana';

// But this overwrites $fruits and it becomes an array
$fruits = array('potassium' => 'banana');
