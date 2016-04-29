function print_array($ar) {
    print '<ul>';
    foreach ($ar as $k => $v) {
        if (is_array($v)) {
            print '<li>' . htmlentities($k) .':</li>';
            print_array($v);
        } else {
            print '<li>' . htmlentities($k) .'=' . htmlentities($v) . '</li>';
        }
    }
    print '</ul>';
}

/* Since this is operating on all form data, it looks directly at $_POST
 * instead of a validated $input array */
function process_form() {
    print_array($_POST);
}