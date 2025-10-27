<?php
function simplifyImagePath($image) {
    $image = parse_url($image)['path'];
    if ($image[0] === '/') {
        $image = substr($image, 1);
    }
    return $image;
}
?>