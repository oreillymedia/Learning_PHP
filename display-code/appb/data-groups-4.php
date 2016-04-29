/* The grades and ID numbers of students in a class:
   An associative array whose key is the student's name and whose value is
   an associative array of grade and ID number
*/
$students = [ 'James D. McCawley' => [ 'grade' => 'A+','id' => 271231 ],
              'Buwei Yang Chao' => [ 'grade' => 'A', 'id' => 818211] ];

/* How many of each item in a store inventory is in stock:
   An associative array whose key is the item name and whose value is the
   number in stock
 */
$inventory = [ 'Wok' => 5, 'Steamer' => 3, 'Heavy Cleaver' => 3,
               'Light Cleaver' => 0 ];

/* School lunches for a week — the different parts of each meal,
   (entree, side dish, drink, etc.) and the cost for each day:
   An associative array whose key is the day and whose value is an
   associative array describing the meal. This associative array has a key/value
   pair for cost and a key/value pair for each part of the meal.
*/
$lunches = [ 'Monday' => [ 'cost' => 1.50,
                           'entree' => 'Beef Shu-Mai',
                           'side' => 'Salty Fried Cake',
                           'drink' => 'Black Tea' ],
             'Tuesday' => [ 'cost' => 2.50,
                           'entree' => 'Clear-steamed Fish',
                           'side' => 'Turnip Cake',
                           'drink' => 'Bubble Tea' ],
             'Wednesday' => [ 'cost' => 2.00,
                           'entree' => 'Braised Sea Cucumber',
                           'side' => 'Turnip Cake',
                           'drink' => 'Green Tea' ],
             'Thursday' => [ 'cost' => 1.35,
                           'entree' => 'Stir-fried Two Winters',
                           'side' => 'Egg Puff',
                           'drink' => 'Black Tea' ],
             'Friday' => [ 'cost' => 3.25,
                           'entree' => 'Stewed Pork with Taro',
                           'side' => 'Duck Feet',
                           'drink' => 'Jasmine Tea' ] ];


/* The names of people in your family:
   A numeric array whose indicies are implict and whose values are the names
   of family members
 */
$family = [ 'Bart', 'Lisa', 'Homer', 'Marge', 'Maggie' ];

/* The names, ages, and relationship to you of people in your family:
   An associative array whose keys are the names of family members and whose
   values are associative arrays with age and relationship key/value pairs
 */
$family = [ 'Bart' => [ 'age' => 10,
                        'relation' => 'brother' ],
            'Lisa' => [ 'age' => 7,
                        'relation' => 'sister' ],
            'Homer' => [ 'age' => 36,
                        'relation' => 'father' ],
            'Marge' => [ 'age' => 34,
                        'relation' => 'mother' ],
            'Maggie' => [ 'age' => 1,
                        'relation' => 'self' ] ];