<?php
//error_reporting(E_ALL);
//set_time_limit(0);
include('fonctions.php');
//header ("Content-type: image/gif");
function combinaisons($longueur){
	$deleted =0;
	$start = time();
	$tailleComb = $longueur;
	$longueur = $longueur*$longueur;
	$limite = pow( 2, $longueur );
	
	$margin = 4;
 	$tailleRenduX = 2055;
	$tailleRenduY = $tailleRenduX;
	$bandeBas = $tailleRenduX;
	$textPlace = $tailleRenduX;
	
	$fontSize = 2;
	$image = imagecreate($tailleRenduX+100,$tailleRenduY+100);
	$blanc = imagecolorallocate($image, 255, 255,255);
	$col["0"] = imagecolorallocate($image, 0, 0, 0);
	$col["1"] = imagecolorallocate($image, 255, 255, 255);

	$ix = 0;
	$iy = 0;
	$imgPart = 0;
	$ideb = 1;
	$ffec = -1000000;
	for( $i=0; $i<$limite; $i++ ){
		$b = str_pad( base_convert( $i, 10, 2 ), $longueur, '0', STR_PAD_LEFT );
		$result = cas($b,1,1);
		$allCas = false;
		if(!isset($result[0]) or !$allCas){
			if(($i-$deleted)%1000000 == 0){$ffec = $ffec+1000000; echo number_format(($limite-$ffec), 0, ',', ' ')."<br />";flush();}
			if($ix > ($tailleRenduX/($margin+$tailleComb))-$margin+$tailleComb){$ix = 0;  $iy++;}
			
			if(($iy*($margin+$tailleComb)) > $bandeBas){
				$titreTxt = $tailleComb."x".$tailleComb." #".str_pad($imgPart, 4, "0", STR_PAD_LEFT)." - ".number_format($ideb, 0, ',', ' ')." > ".number_format($i, 0, ',', ' ')." / ".number_format($limite, 0, ',', ' ')."  +".timeLauched($start)." | POSSIBLE.VERSATILE.FR - ".date("r");
				echo "<br /><br />".$titreTxt."<br /><br />";
				flush();
				imagestring($image, $fontSize, 10, $textPlace, $titreTxt, $col["0"]);
				$imgTo = "images$tailleComb/".str_pad($imgPart, 4, "0", STR_PAD_LEFT)."-all$tailleComb-L.gif";
				imagegif($image, $imgTo,100);
				unset($image);
				
				$image = imagecreate($tailleRenduX,$tailleRenduY);
				$blanc = imagecolorallocate($image, 255, 255,255);
				$col["0"] = imagecolorallocate($image, 0, 0, 0);
				$col["1"] = imagecolorallocate($image, 255, 255, 255);
				$ix = 0;
				$iy = 0;
				$imgPart++;
				$ideb = ($i-$deleted);
			}
			
			$adix = ($margin/2)+($margin+$tailleComb)*$ix;
			$adiy = ($margin/2)+($margin+$tailleComb)*$iy;
			$ix++;
				for ($j = 0; $j < $longueur; $j++) {
					ImageSetPixel($image, ($j%$tailleComb)+$adix, floor($j/$tailleComb)+$adiy, $col[substr($b,$j,1)]);
				}
			
		}else{$deleted++;}
	}
	imagestring($image, $fontSize, 10, $textPlace, $tailleComb."x".$tailleComb." #".str_pad($imgPart, 4, "0", STR_PAD_LEFT)." - ".number_format($ideb, 0, ',', ' ')." > ".number_format($i, 0, ',', ' ')." / ".number_format($limite, 0, ',', ' ')."  +".timeLauched($start)." | POSSIBLE.VERSATILE.FR - ".date("r"), $col["0"]);
	$imgTo = "images$tailleComb/".str_pad($imgPart, 4, "0", STR_PAD_LEFT)."-all$tailleComb-L.gif";
	imagegif($image, $imgTo,100);
	//imagegif($image);
	return $deleted;
}
///////////////////////////////////////////////////
$wToTest = 4;
if(isset($_GET['test'])){$wToTest = $_GET['test'];}
echo combinaisons($wToTest);
///////////////////////////////////////////////////

?>