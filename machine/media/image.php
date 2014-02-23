<?php
include('../_fonctions.php');
header('Content-Type: image/png');
$cache_file = 'images/'.$_GET['backVars'].'.png';

if(!file_exists($cache_file)){

	$arrayUrl = explode("-",$_GET['backVars']);
	$img = trId($arrayUrl[0]);
	$xtaille = $arrayUrl[1];
	
	$image =  imagecreatetruecolor($xtaille*4,$xtaille*4);
	
		$col["0"] = imagecolorallocate($image, 0, 0, 0);
		$col["1"] = imagecolorallocate($image, 255, 255, 255);
	$tailleComb = 4;
	
	for ($j = 0; $j < 16; $j++) {
		$coX = ($j%$tailleComb)*$xtaille;
		$coY = floor($j/$tailleComb)*$xtaille;
		imagefilledrectangle($image, $coX,$coY, $coX+$xtaille,$coY+$xtaille, $col[substr($img,$j,1)]);
	}
	
	if($arrayUrl[2] == "0") imagecolortransparent($image, $col["0"]);
	else imagecolortransparent($image, $col["1"]);
	
	imagepng($image);
	imagepng($image,$cache_file);
	imagedestroy($image);
}else{
	$image = imagecreatefrompng($cache_file);
	imagepng($image);
	imagedestroy($image);
}


?>