class Entree {
    private $name;
    protected $ingredients = array();

    /* Since $name is private, this provides a way to read it */
    public function getName() {
        return $this->name;
    }

    public function __construct($name, $ingredients) {
        if (! is_array($ingredients)) {
            throw new Exception('$ingredients must be an array');
        }
        $this->name = $name;
        $this->ingredients = $ingredients;
    }

    public function hasIngredient($ingredient) {
        return in_array($ingredient, $this->ingredients);
    }
}