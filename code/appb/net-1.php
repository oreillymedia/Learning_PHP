<?php

$json = file_get_contents("http://php.net/releases/?json");
if ($json === false) {
    print "Can't retrieve feed.";
}
else {
    $feed = json_decode($json, true);
    // $feed is an array whose top-level keys are major release
    // numbers. First we need to pick the biggest one.
    $major_numbers = array_keys($feed);
    rsort($major_numbers);
    $biggest_major_number = $major_numbers[0];
    // The "version" element in the array under the major number
    // key is the latest release for that major version number
    $version = $feed[$biggest_major_number]['version'];
    print "The latest version of PHP released is $version.";
}