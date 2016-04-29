<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $defaults = $_POST;
} else {
    $defaults = array('delivery'  => 'yes',
                      'size'      => 'medium',
                      'main_dish' => array('taro','tripe'),
                      'sweet'     => 'cake');
}
