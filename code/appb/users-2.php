<?php
$view_count = 1 + ($_COOKIE['view_count'] ?? 0);

if ($view_count == 20) {
    // An empty value for setcookie() removes the cookie
    setcookie('view_count', '');
    $msg = "<p>Time to start over.</p>";
} else {
    setcookie('view_count', $view_count);
    $msg = "<p>Hi! Number of times you've viewed this page: $view_count.</p>";
    if ($view_count == 5) {
        $msg .= "<p>This is your fifth visit.</p>";
    } elseif ($view_count == 10) {
        $msg .= "<p>This is your tenth visit. You must like this page.</p>";
    } elseif ($view_count == 15) {
        $msg .= "<p>This is your fifteenth visit. " .
                "Don't you have anything else to do?</p>";
    }
}
print $msg;
