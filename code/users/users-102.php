<?php
session_start( );

$main_dishes = array('cuke' => 'Braised Sea Cucumber',
                     'stomach' => "Sauteed Pig's Stomach",
                     'tripe' => 'Sauteed Tripe with Wine Sauce',
                     'taro' => 'Stewed Pork with Taro',
                     'giblets' => 'Baked Giblets with Salt', 
                     'abalone' => 'Abalone with Marrow and Duck Feet');

if (isset($_SESSION['order']) && (count($_SESSION['order']) > 0)) {
    print '<ul>';
    foreach ($_SESSION['order'] as $order) {
        $dish_name = $main_dishes[ $order['dish'] ];
        print "<li> $order[quantity] of $dish_name </li>";
    } 
    print "</ul>";
} else {
    print "You haven't ordered anything.";
}
?>
