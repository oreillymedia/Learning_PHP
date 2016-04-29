/* Using dechex(): */
function web_color1($red, $green, $blue) {
    $hex = [ dechex($red), dechex($green), dechex($blue) ];
    // Prepend a leading 0 if necessary to 1 digit hex values
    foreach ($hex as $i => $val) {
        if (strlen($i) == 1) {
            $hex[$i] = "0$val";
        }
    }
    return '#' . implode('', $hex);
}

/* You can also rely on sprintf()'s %x format character to do
   hex-to-decimal conversion: */
function web_color2($red, $green, $blue) {
    return sprintf('#%02x%02x%02x', $red, $green, $blue);
}