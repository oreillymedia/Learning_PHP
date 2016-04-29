<?php
// $_POST['mo'], $_POST['dy'], and $_POST['yr']
// contain month number, day, and year submitted
// from a form.
//
// $_POST['hr'], $_POST['mn'] contain
// hour and minute submitted from a form

// $d contains the current time, but soon that will
// be overridden.
$d = new DateTime();

$d->setDate($_POST['yr'], $_POST['mo'], $_POST['dy']);
$d->setTime($_POST['hr'], $_POST['mn']);

print $d->format('r');