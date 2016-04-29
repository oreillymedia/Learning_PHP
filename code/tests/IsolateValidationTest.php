<?php
// validate_form() is defined in this file
include 'isolate-validation.php';

class IsolateValidationTest extends PHPUnit_Framework_TestCase {

    public function testDecimalAgeNotValid() {
        $submitted = array('age' => '6.7',
                           'price' => '100',
                           'name' => 'Julia');
        list($errors, $input) = validate_form($submitted);
        // Expecting only one error -- about age
        $this->assertContains('Please enter a valid age.', $errors);
        $this->assertCount(1, $errors);
    }

    public function testDollarSignPriceNotValid() {
        $submitted = array('age' => '6',
                           'price' => '$52',
                           'name' => 'Julia');
        list($errors, $input) = validate_form($submitted);
        // Expecting only one error -- about age
        $this->assertContains('Please enter a valid price.', $errors);
        $this->assertCount(1, $errors);
    }

    public function testValidDataOK() {
        $submitted = array('age' => '15',
                           'price' => '39.95',
                           // Some whitespace around name that
                           // should be trimmed
                           'name' => '  Julia  ');
        list($errors, $input) = validate_form($submitted);
        // Expecting no errors
        $this->assertCount(0, $errors);
        // Expecting 3 things in input
        $this->assertCount(3, $input);
        $this->assertSame(15, $input['age']);
        $this->assertSame(39.95, $input['price']);
        $this->assertSame('Julia', $input['name']);
    }
}