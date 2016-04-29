public function testNameMustBeSubmitted() {
        $submitted = array('age' => '15',
                           'price' => '39.95');
        list($errors, $input) = validate_form($submitted);
        $this->assertContains('Your name is required.', $errors);
        $this->assertCount(1, $errors);

    }