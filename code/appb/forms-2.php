<?php
/* Since this is operating on all form data, it looks directly at $_POST
 * instead of a validated $input array */
function process_form() {
    print '<ul>';
    foreach ($_POST as $k => $v) {
        print '<li>' . htmlentities($k) .'=' . htmlentities($v) . '</li>';
    }
    print '</ul>';
}