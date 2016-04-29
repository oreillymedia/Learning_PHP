class Entree {
    public $name;
    public $ingredients = array();

    public function hasIngredient($ingredient) {
        return in_array($ingredient, $this->ingredients);
    }

    public static function getSizes() {
        return array('small','medium','large');
    }
}