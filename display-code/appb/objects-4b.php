class PricedEntree extends Entree {
    public function __construct($name, $ingredients) {
        parent::__construct($name, $ingredients);
        foreach ($this->ingredients as $ingredient) {
            if (! $ingredient instanceof \Meals\Ingredient) {
                throw new Exception('Elements of $ingredients must be Ingredient objects');
            }
        }
    }

    public function getCost() {
        $cost = 0;
        foreach ($this->ingredients as $ingredient) {
            $cost += $ingredient->getCost();
        }
        return $cost;
    }
}