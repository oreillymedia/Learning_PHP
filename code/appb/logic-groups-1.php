<?php
function html_img($url, $alt = null, $height = null, $width = null) {
    $html = '<img src="' . $url . '"';
    if (isset($alt)) {
        $html .= ' alt="' . $alt . '"';
    }
    if (isset($height)) {
        $html .= ' height="' . $height . '"';
    }
    if (isset($width)) {
        $html .= ' width="' . $width . '"';
    }
    $html .= '/>';
    return $html;
}