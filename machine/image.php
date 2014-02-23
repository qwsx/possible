<?php
header ("Content-type: image/png");
include('fonctions.php');
$arrayUrl = explode("-",$_GET['backVars']);
$img = trId($arrayUrl[0]);
$xtaille = $arrayUrl[1];
//if($xtaille > 200 or $xtaille < 1)$xtaille = 1;
$color = $arrayUrl[2];
		$image =  imagecreatetruecolor($xtaille*4,$xtaille*4);
		$col["0"] = imagecolorallocate($image, 0, 0, 0);
		$col["1"] = imagecolorallocate($image, 255, 255, 255);
		$tailleComb = 4;
			for ($j = 0; $j < 16; $j++) {
					$coX = ($j%$tailleComb)*$xtaille;
					$coY = floor($j/$tailleComb)*$xtaille;
					ImageFilledRectangle ($image, $coX,$coY, $coX+$xtaille,$coY+$xtaille, $col[substr($img,$j,1)]);
			}
		imagecolortransparent($image, $col["1"]);
imagepng($image);
imagedestroy($image);
?>