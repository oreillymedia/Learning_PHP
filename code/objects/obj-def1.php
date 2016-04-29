<?php

class Entree {
    public $name;
    public $ingredients = array();

    public function hasIngredient($ingredient) {
        return in_array($ingredient, $this->ingredients);
    }
}