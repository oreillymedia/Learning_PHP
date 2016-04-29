<?php
foreach (file('people.txt') as $line) {
    $line = trim($line);
    $info = explode('|', $line);
    print '<li><a href="mailto:' . $info[0] . '">' . $info[1] ."</li>\n";
}
