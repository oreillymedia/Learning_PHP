$totals = restaurant_check2(15.22, 8.25, 15);

if ($totals[0] < 20) {
    print 'The total without tip is less than $20.';
}
if ($totals[1] < 20) {
    print 'The total with tip is less than $20.';
}