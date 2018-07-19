<?php
$image = imagecreatetruecolor(230,50);
// Writes the text and apply a gaussian blur on the image
//$color = imagecolorclosestalpha($image,240,139,90,10);
$color = imagecolorallocate($image,mt_rand(200,255),mt_rand(150,255),mt_rand(150,255));
$str = 'abcedfghijklmnopkrstuvwxyzABCDEFGHIJKLMNOPKRSTUVWXY1234567890';

$len = mb_strlen($str);
// 花 干扰
$x = 5;
for($i=0;$i<12;$i++){
    $letter = mb_substr($str,mt_rand(0,$len),1);
    imagettftext($image,mt_rand(22,28),0,$x,mt_rand(22,45),$color,__DIR__.'/fonts/MandingsDemo.ttf',$letter);
    $x += 18;
}
// 点干扰

for($k=0;$k<200;$k++){
    imagesetpixel($image,mt_rand(0,230),mt_rand(0,50),$color);
}

for($k=0;$k<25;$k++){
    imageline($image,mt_rand(0,230),mt_rand(0,50),mt_rand(0,230),mt_rand(0,50),$color);
}

$gaussian = array(array(2.0, 3.0, 5.0), array(3.0, 4.0, 3.0), array(3.0, 4.0, 5.0));
imageconvolution($image, $gaussian, 40, 24);

$str2 = '1234567890';
$len2 = mb_strlen($str2);

$letter2 = '';
for($j=0;$j<7;$j++){
    $letter2 .= mb_substr($str2,mt_rand(0,$len2-1),1);

}

imagettftext($image,32,0,20,37,$color,__DIR__.'/fonts/COMICATE.TTF',$letter2);


// Rewrites the text for comparison

header('Content-Type: image/png');
$a = 2;
if($a === 1) imagepng($image, 'php.png', 9);
if ($a === 2) imagepng($image, null, 9);
