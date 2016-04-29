<?php
function restaurant_check($meal, $tax, $tip, $include_tax_in_tip = false) {
    $tax_amount = $meal * ($tax / 100);
    if ($include_tax_in_tip) {
        $tip_base = $meal + $tax_amount;
    } else {
        $tip_base = $meal;
    }
    $tip_amount = $tip_base * ($tip / 100);
    $total_amount = $meal + $tax_amount + $tip_amount;

    return $total_amount;
}