$fmtfavs = new MessageFormatter('en_GB', $messages['en_GB']['FAVORITE_FOODS']);
$fmtcookie = new MessageFormatter('en_GB', $messages['en_GB']['COOKIE']);

// This returns "biscuit"
$cookie = $fmtcookie->format(array());

// This prints the sentence with "biscuit" substituted
print $fmtfavs->format(array($cookie));