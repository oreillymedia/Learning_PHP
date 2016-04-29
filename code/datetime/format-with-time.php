<?php
// If just a time is supplied, the current date is used for day/month/year
$a = new DateTime('10:36 am');
// If just a date is supplied, the current time is used for hour/minute/second
$b = new DateTime('5/11');
$c = new DateTime('March 5th 2017');
$d = new DateTime('3/10/2018');
$e = new DateTime('2015-03-10 17:34:45');
// DateTime understands microseconds
$f = new DateTime('2015-03-10 17:34:45.326425');
// Epoch timestamp must be prefixed with @
$g = new DateTime('@381718923');
// Common log format
$h = new DateTime('3/Mar/2015:17:34:45 +0400');

// Relative formats, too!
$i = new DateTime('next Tuesday');
$j = new DateTime("last day of April 2015");
$k = new DateTime("November 1, 2012 + 2 weeks");
