<?php
print '<input type="checkbox" name="delivery" value="yes"';
if ($defaults['delivery'] == 'yes') { print ' checked'; }
print '> Delivery?';

$checkbox_options = array('small' => 'Small',
                          'medium' => 'Medium',
                          'large' => 'Large');

foreach ($checkbox_options as $value => $label) {
    print '<input type="radio" name="size" value="'.$value.'"';
    if ($defaults['size'] == $value) { print ' checked'; }
    print "> $label ";
}
