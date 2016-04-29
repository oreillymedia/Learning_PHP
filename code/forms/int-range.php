<?php

$input['age'] = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT,
                             array('options' => array('min_range' => 18,
                                                      'max_range' => 65)));
if (is_null($input['age']) || ($input['age'] === false)) {
    $errors[] = 'Please enter a valid age between 18 and 65.';
}
