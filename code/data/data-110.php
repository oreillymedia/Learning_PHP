<?php
$username = 'james';
$domain = '@example.com';

// Concatenate $domain to the end of $username the regular way
$username = $username . $domain;
// Concatenate with the combined operator
$username .= $domain;