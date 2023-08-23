<?php
session_start();

//CAPTCHA Constants 
define ('CAPTCHA_NUMCHARS',6);//number of character in pass-phrase 
define('CAPTCHA_WIDTH',200);//width of image
define('CAPTCHA_HEIGHT',40);//height of image

//Generate the random pass-phrase 
$pass_phrase="";
for($i=0;$i<CAPTCHA_NUMCHARS;$i++){
    $pass_phrase .=chr(rand(97,122));
}

$_SESSION['pass_phrase']=sha1($pass_phrase);// sha1 encryption in PHP and SHA is for SQL resulting in a string of 40 hexadecimal characters there is no “decrypt” function

// Create the image 
$img = imagecreatetruecolor(CAPTCHA_WIDTH,CAPTCHA_HEIGHT); //return img identifier 

//set a white background with black text and gray graphics 
$bg_color = imagecolorallocate($img,255,255,255);//white => return a Color identifier
$text_color = imagecolorallocate($img,0,0,0);//black => return a Color identifier
$graphic_color = imagecolorallocate($img,64,64,64);//darck gray => return a Color identifier

//Fill the background 
imagefilledrectangle($img,0,0,CAPTCHA_WIDTH,CAPTCHA_HEIGHT,$bg_color);

//Draw some random lines 
for($i=0;$i<8 ;$i++){
    imageline($img , 0,rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH ,rand() % CAPTCHA_HEIGHT , $graphic_color );
}


//Sprinkle in some random dots 
for($i=0;$i<60;$i++){
    imagesetpixel($img,rand() % CAPTCHA_WIDTH ,rand() % CAPTCHA_HEIGHT , $graphic_color );  
}

//Draw the pass-phrase string 
imagettftext($img,18,6,55,CAPTCHA_HEIGHT-10,$text_color,"OpenSans-Bold.ttf",$pass_phrase);

//output the image as a png using header 
header("Content-type: image/png");

imagepng($img);

//Clean Up
imagedestroy($img);

?>