<?php

include 'restaurant-check.php';

class RestaurantCheckTest extends PHPUnit_Framework_TestCase {

    public function testWithTaxAndTip() {
        $meal = 100;
        $tax = 10;
        $tip = 20;
        $result = restaurant_check($meal, $tax, $tip);
        $this->assertEquals(130, $result);
    }

}
