<?php
header ("Content-type: image/gif");

function mkId($pos){
	return dechex(bindec($pos));
}
function trId($id){
	return str_pad(decbin(hexdec($id)), 16, "0", STR_PAD_LEFT);
}

if(!isset($_GET['nbinaire'])){$nbr_binaire = str_pad(decbin($_GET['nombre']), 16, "0", STR_PAD_LEFT);}else{$nbr_binaire = $_GET['nbinaire'];}
$id =  mkId($nbr_binaire);
$re = trId($id);
$image = imagecreate(4,4);
			$col["0"] = imagecolorallocate($image, 0, 0, 0);
			$col["1"] = imagecolorallocate($image, 255, 255, 255);

$tailleComb = 4;
		for ($j = 0; $j < 16; $j++) {
				ImageSetPixel($image, ($j%$tailleComb), floor($j/$tailleComb), $col[substr($re,$j,1)]);
		}
imagegif($image);
?>