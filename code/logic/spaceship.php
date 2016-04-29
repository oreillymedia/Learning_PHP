<?php

// $a is a negative number since 1 is less than 12.7
$a = 1 <=> 12.7;

// $b is a positive number since "c" comes after "b"
$b = "charlie" <=> "bob";

// Comparing numeric strings works like < and >, not like strcmp()
$x = '6 pack' <=> '55 card stud';
if ($x > 0) {
    print 'The string "6 pack" is greater than than the string "55 card stud".';
} elseif ($x < 0) {
    print 'The string "6 pack" is less than the string "55 card stud".';
}

// Comparing numeric strings works like < and >, not like strcmp()
$x ='6 pack' <=> 55;
if ($x > 0) {
    print 'The string "6 pack" is greater than the number 55.';
} elseif ($x < 0) {
    print 'The string "6 pack" is less than the number 55.';
}
