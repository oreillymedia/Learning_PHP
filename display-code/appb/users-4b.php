session_start();

// The same products from the order page
$products = ['cuke'    => 'Braised Sea Cucumber',
             'stomach' => "Sauteed Pig's Stomach",
             'tripe'   => 'Sauteed Tripe with Wine Sauce',
             'taro'    => 'Stewed Pork with Taro',
             'giblets' => 'Baked Giblets with Salt',
             'abalone' => 'Abalone with Marrow and Duck Feet'];

// Simplified main page logic without form validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    process_form();
} else {
    // The form wasn't submitted, so display
    show_form();
}

function show_form() {
    global $products;

    // The "form" is just a single submit button, so we won't use
    // FormHelper and just inline all the HTML here
    if (isset($_SESSION['quantities']) && (count($_SESSION['quantities'])>0)) {
        print "<p>Your order:</p><ul>";
        foreach ($_SESSION['quantities'] as $field => $amount) {
            list($junk, $code) = explode('_', $field);
            $product = $products[$code];
            print "<li>$amount $product</li>";
        }
        print "</ul>";
        print '<form method="POST" action=' .
              htmlentities($_SERVER['PHP_SELF']) . '>';
        print '<input type="submit" value="Check Out" />';
        print '</form>';
    } else {
        print "<p>You don't have a saved order.</p>";
    }
    // This assumes the order form page is saved as "order.php"
    print '<a href="order.php">Return to Order page</a>';
}

function process_form() {
    // This removes the data from the session
    unset($_SESSION['quantities']);
    print "<p>Thanks for your order.</p>";
}