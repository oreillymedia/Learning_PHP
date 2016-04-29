<?php
// These values are compared using dictionary order
if ("x54321"> "x5678") {
    print 'The string "x54321" is greater than the string "x5678".';
} else {
    print 'The string "x54321" is not greater than the string "x5678".';
}

// These values are compared using numeric order
if ("54321" > "5678") {
    print 'The string "54321" is greater than the string "5678".';
} else {
    print 'The string "54321" is not greater than the string "5678".';
}

// These values are compared using dictionary order
if ('6 pack' < '55 card stud') {
    print 'The string "6 pack" is less than than the string "55 card stud".';
} else {
    print 'The string "6 pack" is not less than the string "55 card stud".';
}

// These values are compared using numeric order
if ('6 pack' < 55) {
    print 'The string "6 pack" is less than the number 55.';
} else {
    print 'The string "6 pack" is not less than the number 55.';
}