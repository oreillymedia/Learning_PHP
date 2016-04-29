$f = -50;
while ($f <= 50) {
    $c = ($f - 32) * (5/9);
    printf("%d degrees F = %d degrees C\n", $f, $c);
    $f += 5;
}