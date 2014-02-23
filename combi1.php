<?php
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);
include('fonctions.php');
function combinaisons($longueur){
	$start = time();
	$tailleComb = $longueur;
	$longueur = $longueur*$longueur;
	$limite = pow( 2, $longueur );
	
	$margin = 8;
 	$tailleRenduX = 3100;
	$tailleRenduY = $tailleRenduX;
	$bandeBas = $tailleRenduX;
	$textPlace = 3085;
	$fontSize = 2;
	$image = imagecreate($tailleRenduX,$tailleRenduY);
	$blanc = imagecolorallocate($image, 255, 255,255);
	$col["0"] = imagecolorallocate($image, 0, 0, 0);
	$col["1"] = imagecolorallocate($image, 255, 255, 255);

	$ix = 0;
	$iy = 0;
	$imgPart = 0;
	$ideb = 1;
	$ffec = -1000000;
	for( $i=0; $i<$limite; $i++ ){
		if($i%1000000 == 0){$ffec = $ffec+1000000; echo number_format(($limite-$ffec), 0, ',', ' ')."<br />";flush();}
		if($ix > ($tailleRenduX/($margin+$tailleComb))-$margin+$tailleComb){$ix = 0;  $iy++;}
		
		if(($iy*($margin+$tailleComb)) > $bandeBas){
			$titreTxt = $tailleComb."x".$tailleComb." #".str_pad($imgPart, 4, "0", STR_PAD_LEFT)." - ".number_format($ideb, 0, ',', ' ')." > ".number_format($i, 0, ',', ' ')." / ".number_format($limite, 0, ',', ' ')."  +".timeLauched($start)." | VERSATILE.FR - ".date("r");
			echo "<br /><br />".$titreTxt."<br /><br />";
			flush();
			imagestring($image, $fontSize, 10, $textPlace, $titreTxt, $col["0"]);
			$imgTo = "images$tailleComb/".str_pad($imgPart, 4, "0", STR_PAD_LEFT)."-all$tailleComb.gif";
			imagegif($image, $imgTo,100);
			unset($image);
			
			$image = imagecreate($tailleRenduX,$tailleRenduY);
			$blanc = imagecolorallocate($image, 255, 255,255);
			$col["0"] = imagecolorallocate($image, 0, 0, 0);
			$col["1"] = imagecolorallocate($image, 255, 255, 255);
			$ix = 0;
			$iy = 0;
			$imgPart++;
			$ideb = $i;
		}
		
		$adix = ($margin/2)+($margin+$tailleComb)*$ix;
		$adiy = ($margin/2)+($margin+$tailleComb)*$iy;
		$ix++;
		
		$s = str_pad( base_convert( $i, 10, 2 ), $longueur, '0', STR_PAD_LEFT );
		if(existAvant($s)){
			for ($j = 0; $j < $longueur; $j++) {
				ImageSetPixel($image, ($j%$tailleComb)+$adix, floor($j/$tailleComb)+$adiy, $col[substr($s,$j,1)]);
			}
		}
	}
	imagestring($image, $fontSize, 10, $textPlace, $tailleComb."x".$tailleComb." #".str_pad($imgPart, 4, "0", STR_PAD_LEFT)." - ".number_format($ideb, 0, ',', ' ')." > ".number_format($i, 0, ',', ' ')." / ".number_format($limite, 0, ',', ' ')."  +".timeLauched($start)." | VERSATILE.FR - ".date("r"), $col["0"]);
	$imgTo = "images$tailleComb/".str_pad($imgPart, 4, "0", STR_PAD_LEFT)."-all$tailleComb.gif";
	imagegif($image, $imgTo,100);
}
///////////////////////////////////////////////////
$wToTest = 3;
if(isset($_GET['test'])){$wToTest = $_GET['test'];}
combinaisons($wToTest);
///////////////////////////////////////////////////
?><img src="images4/0000-all4.gif" alt="" />