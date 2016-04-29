<?php

include 'restaurant-check-tip.php';

class RestaurantCheckTest extends PHPUnit_Framework_TestCase {

    public function testWithTaxAndTip() {
        $meal = 100;
        $tax = 10;
        $tip = 20;
        $result = restaurant_check($meal, $tax, $tip);
        $this->assertEquals(130, $result);
    }

    public function testWithNoTip() {
        $meal = 100;
        $tax = 10;
        $tip = 0;
        $result = restaurant_check($meal, $tax, $tip);
        $this->assertEquals(110, $result);
    }

    public function testTipIsNotOnTax() {
        $meal = 100;
        $tax = 10;
        $tip = 10;
        $checkWithTax = restaurant_check($meal, $tax, $tip);
        $checkWithoutTax = restaurant_check($meal, 0, $tip);
        $expectedTax = $meal * ($tax / 100);
        $this->assertEquals($checkWithTax, $checkWithoutTax + $expectedTax);
    }

public function testTipShouldIncludeTax() {
    $meal = 100;
    $tax = 10;
    $tip = 10;
    // 4th argument of true says that the tax should be included
    // in the tip-calculation amount
    $result = restaurant_check($meal, $tax, $tip, true);
    $this->assertEquals(121, $result);
}

public function testTipShouldNotIncludeTax() {
    $meal = 100;
    $tax = 10;
    $tip = 10;
    // 4th argument of false says that the tax should explicitly
    // NOT be included in the tip-calculation amount
    $result = restaurant_check($meal, $tax, $tip, false);
    $this->assertEquals(120, $result);
}
}