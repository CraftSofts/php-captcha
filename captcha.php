<?php
session_start();
$captcha = '';
$captchaHeight = 60;
$captchaWidth = 150;
$totalCharacters = 5; 
$randomDots = 70;
$randomLines = 30;
$possibleLetters = '123456789mnbvcxzasdfghjklpoiuytrewwq';
$fonts = array('CabinSketch-Regular.ttf','MonoFont-Regular.ttf','BubblegumSans-Regular.ttf','Schoolbell-Regular.ttf');
$colors = array('ff0000','329e00','009e6f','00529e','2a009e','cf0000','00a884','009da8');
$rand = $fonts[mt_rand(0, count($fonts) - 1)];
$captchaFont = __DIR__.'/fonts/'.$rand; 
$textColor = $noiseColor = $colors[mt_rand(0, count($colors) - 1)];
$character = 0;
while ($character < $totalCharacters) { 
	$captcha .= substr($possibleLetters, mt_rand(0, strlen($possibleLetters)-1), 1);
	$character++;
} 
$captchaFontSize = $captchaHeight * 0.65;
$captchaImage = @imagecreate(
	$captchaWidth,
	$captchaHeight
); 
$backgroundColor = imagecolorallocate(
 $captchaImage,
 255,
 255,
 255
); 
$arrayTextColor = hextorgb($textColor);
$textColor = imagecolorallocate(
 $captchaImage,
 $arrayTextColor['red'],
 $arrayTextColor['green'],
 $arrayTextColor['blue']
); 
$arrayNoiseColor = hextorgb($noiseColor);
$imageNoiseColor = imagecolorallocate(
 $captchaImage,
 $arrayNoiseColor['red'],
 $arrayNoiseColor['green'],
 $arrayNoiseColor['blue']
); 
for( $captchaDotsCount=0; $captchaDotsCount<$randomDots; $captchaDotsCount++ ) {
imagefilledellipse(
	 $captchaImage,
	 mt_rand(0,$captchaWidth),
	 mt_rand(0,$captchaHeight),
	 2,
	 3,
	 $imageNoiseColor
 );
}
for( $captchaLinesCount=0; $captchaLinesCount<$randomLines; $captchaLinesCount++ ) {
	imageline(
		$captchaImage,
		mt_rand(0,$captchaWidth),
		mt_rand(0,$captchaHeight),
		mt_rand(0,$captchaWidth),
		mt_rand(0,$captchaHeight),
		$imageNoiseColor
	);
} 
$text_box = imagettfbbox(
	$captchaFontSize,
	0,
	$captchaFont,
	$captcha
); 
$x = ($captchaWidth - $text_box[4])/2;
$y = ($captchaHeight - $text_box[5])/2;
imagettftext(
	$captchaImage,
	$captchaFontSize,
	0,
	$x,
	$y,
	$textColor,
	$captchaFont,
	$captcha
); 
header('Content-Type: image/jpeg'); 
imagejpeg($captchaImage); 
imagedestroy($captchaImage);
$_SESSION['captcha'] = $captcha; 
function hextorgb ($hexstring){
	$integar = hexdec($hexstring);
	return array(
		"red" => 0xFF & ($integar >> 0x10),
		"green" => 0xFF & ($integar >> 0x8),
		"blue" => 0xFF & $integar
	);
}
?>