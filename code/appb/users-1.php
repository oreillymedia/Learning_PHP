<?php
$view_count = 1 + ($_COOKIE['view_count'] ?? 0);
setcookie('view_count', $view_count);
print "<p>Hi! Number of times you've viewed this page: $view_count.</p>";
