<?php
for ($f = -50; $f <= 50; $f += 5) {
    $c = ($f - 32) * (5/9);
    printf("%d degrees F = %d degrees C\n", $f, $c);
}