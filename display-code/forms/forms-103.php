// Make a DateTime object for 6 months ago
$range_start = new DateTime('6 months ago');
// Make a DateTime object for right now
$range_end   = new DateTime();

// 4-digit year is in $_POST['year']
// 2-digit month is in $_POST['month']
// 2-digit day is is $_POST['day']
$input['year'] = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT,
                              array('options' => array('min_range' => 1900,
                                                       'max_range' => 2100)));
$input['month'] = filter_input(INPUT_POST, 'month', FILTER_VALIDATE_INT,
                               array('options' => array('min_range' => 1,
                                                        'max_range' => 12)));
$input['day'] = filter_input(INPUT_POST, 'day', FILTER_VALIDATE_INT,
                             array('options' => array('min_range' => 1,
                                                      'max_range' => 31)));
// No need to use === to compare to false since 0 is not a valid
// choice for year, month, or day. checkdate() makes sure that
// the number of days is valid for the given month and year
if ($input['year'] && input['month'] && input['day'] &&
    checkdate($input['month'], $input['day'], $input['year'])) {
    $submitted_date = new DateTime(strtotime($input['year'] . '-' .
                                             $input['month'] . '-' .
                                             $input['day']));
    if (($range_start > $submitted_date) || ($range_end < $submitted_date)) {
        $errors[] = 'Please choose a date less than six months old.';
    }
} else {
    // This happens if someone omits one of the form parameters or submits
    // something like February 31.
    $errors[] = 'Please enter a valid date.';
}