// Remove slashes from user
$user = str_replace('/', '', $_POST['user']);
// Remove .. from user
$user = str_replace('..', '', $user);

if (is_readable("/usr/local/data/$user")) {
    print 'User profile for ' . htmlentities($user) .': <br/>';
    print file_get_contents("/usr/local/data/$user");
}