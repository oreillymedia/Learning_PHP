$is_https = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on'));
if (! $is_https) {
    $newUrl = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $newUrl");
    exit();
}
print "You accessed this page over HTTPS. Yay!";