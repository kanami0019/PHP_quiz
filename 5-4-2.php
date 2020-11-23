<?php
$width = 0;
$height = 0;
function triangle_area($a,$h){
    global $height, $width;
    $width = $a;
    $height = $h;
    return $width*$height/2;
    // print($width*$height/2);
}
$num = triangle_area(2,3);
print($num);
?>
