<?php
class Ingredient {
    protected $name;
    protected $cost;

    public function __construct($name, $cost) {
        $this->name = $name;
        $this->cost = $cost;
    }

    public function getName() {
        return $this->name;
    }

    public function getCost() {
        return $this->cost;
    }

    // This method sets the cost to a new value
    public function setCost($cost) {
        $this->cost = $cost;
    }

}