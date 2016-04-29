$sweets = array('puff' => 'Sesame Seed Puff',
                'square' => 'Coconut Milk Gelatin Square',
                'cake' => 'Brown Sugar Cake',
                'ricemeat' => 'Sweet Rice and Meat');

function generate_options_with_value ($options) {
    $html = '';
    foreach ($options as $value => $option) {
        $html .= "<option value=\"$value\">$option</option>\n";
    }
    return $html;
}


// Display the form
function show_form( ) {
    $sweets = generate_options_with_value($GLOBALS['sweets']);
    print<<<_HTML_
<form method="post" action="$_SERVER[PHP_SELF]">
Your Order: <select name="order">
$sweets
</select>
<br/>
<input type="submit" value="Order">
</form>
_HTML_;
}