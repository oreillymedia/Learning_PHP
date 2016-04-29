<?php

class ComboMeal extends Entree {

    public function __construct($name, $entrees) {
        parent::__construct($name, $entrees);
        foreach ($entrees as $entree) {
            if (! $entree instanceof Entree) {
                throw new Exception('Elements of $entrees must be Entree objects');
            }
        }
    }

    public function hasIngredient($ingredient) {
        foreach ($this->ingredients as $entree) {
            if ($entree->hasIngredient($ingredient)) {
                return true;
            }
        }
        return false;
    }
}
