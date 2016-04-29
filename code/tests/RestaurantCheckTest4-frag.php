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
