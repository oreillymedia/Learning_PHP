<?php

include 'FormHelper.php';

class FormHelperTest extends PHPUnit_Framework_TestCase {

    public $products = [ 'cu&ke'    => 'Braised <Sea> Cucumber',
                         'stomach' => "Sauteed Pig's Stomach",
                         'tripe'   => 'Sauteed Tripe with Wine Sauce',
                         'taro'    => 'Stewed Pork with Taro',
                         'giblets' => 'Baked Giblets with Salt',
                         'abalone' => 'Abalone with Marrow and Duck Feet'];
    public $stooges = ['Larry','Moe','Curly','Shemp'];

    // This code gets run before each test. Putting it in
    // the special setUp() method is more concise than having
    // to repeat it in each test method
    public function setUp() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
    }

    public function testAssociativeOptions() {
        $form = new FormHelper();
        $html = $form->select($this->products);
        $this->assertEquals($html,<<<_HTML_
<select ><option  value="cu&amp;ke">Braised &lt;Sea&gt; Cucumber</option><option  value="stomach">Sauteed Pig's Stomach</option><option  value="tripe">Sauteed Tripe with Wine Sauce</option><option  value="taro">Stewed Pork with Taro</option><option  value="giblets">Baked Giblets with Salt</option><option  value="abalone">Abalone with Marrow and Duck Feet</option></select>
_HTML_
        );
    }

    public function testNumericOptions() {
        $form = new FormHelper();
        $html = $form->select($this->stooges);
        $this->assertEquals($html,<<<_HTML_
<select ><option  value="0">Larry</option><option  value="1">Moe</option><option  value="2">Curly</option><option  value="3">Shemp</option></select>
_HTML_
        );
    }

    public function testNoOptions() {
        $form = new FormHelper();
        $html = $form->select([]);
        $this->assertEquals('<select ></select>', $html);
    }

    public function testBooleanTrueAttributes() {
        $form = new FormHelper();
        $html = $form->select([],['np' => true]);
        $this->assertEquals('<select np></select>', $html);

    }

    public function testBooleanFalseAttributes() {
        $form = new FormHelper();
        $html = $form->select([],['np' => false, 'onion' => 'red']);
        $this->assertEquals('<select onion="red"></select>', $html);
    }

    public function testNonBooleanAttributes() {
        $form = new FormHelper();
        $html = $form->select([],['spaceship'=>'<=>']);
        $this->assertEquals('<select spaceship="&lt;=&gt;"></select>', $html);
    }

    public function testMultipleAttribute() {
        $form = new FormHelper();
        $html = $form->select([],["name" => "menu",
                                  "q" => 1, "multiple" => true]);
        $this->assertEquals('<select name="menu[]" q="1" multiple></select>', $html);
    }
}