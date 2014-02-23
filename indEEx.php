<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	/*$co = 8;
	$nbPx = $co*$co;
	for ($p = 1; $p <= $nbPx; $p++) {
	
		$image = imagecreate($co,$co);
		$blanc = imagecolorallocate($image, 255, 255, 255);
		$noir = imagecolorallocate($image, 0, 0, 0);
		$co = explode(",",findX($id,$co));
		
		for ($pin = $p; $pin <= $nbPx; $pin++) {
			$ci = explode(",",findX($id,$co));
			
			ImageSetPixel ($image, $ci[0], $y, $couleur);
			
		}	
	}
	function findX($id,$co) {
		$x = floor($id/$co);
		$y = $id%$co;
		 return "$x,$y";
 	}
	findX(10,8);*/

/*$t = array (0, 0, 0, 0, 0);

while($t[0].$t[1].$t[2].$t[3].$t[4]!= "11111") { 
	$n=0;	
	while($t[$n] == 1){
		$t[$n] = 0;

  }
  $t[$n] = 1;

  echo $t[0].$t[1].$t[2].$t[3].$t[4]."<br />";
}
*/
/*
$tableau = array('1', '0');
echo "Possibilités: ".(count($tableau)*count($tableau));
$tableau_resultat = array();
$x = 0;
for($i = 0; $i<count($tableau); $i++) {
   for($u=0; $u<count($tableau); $u++) {
      $possibilite = $tableau[$i];
      for($y=$u; $x<count($tableau); $y++) {
         if (!isset($tableau[$y])) $y = 0;
         if ($y != $i) $possibilite .= $tableau[$y];
         $x++;
      }
      $tableau_resultats[] = $possibilite;
      $x = 0;
   }
}
echo "<pre>";
print_r(array_unique($tableau_resultats));
echo "</pres>";

	function cree_tableau_indices() {
		global $longueur_tableau;
		global $tableau_indices;
		
		for ($i = 0; $i < $longueur_tableau; $i++) {
			array_push($tableau_indices, 0);
		}
	}
	
 
	
	function augmente_indice($position) {
		global $tableau_indices;
		global $index_max;
		global $tableau_valeurs_possibles;
		
		
		if ($tableau_indices[$position] < $index_max) {			// Si l'indice de la position en cours est inférieur a d'indice max 
				$tableau_indices[$position]++;
				$position = $index_max;
			if ($tableau_indices == array_unique($tableau_indices)) {
				$tableau_valeurs_possibles[] = $tableau_indices;
			}
		} else {
			$tableau_indices[$position] = 0;
			$position--;
		}
		if ($position >= 0) {
			augmente_indice($position);
		}
	}
	
	
	
	$tableau_indices = array();
	$tableau = array('0', '1');	
	
	$longueur_tableau = count($tableau);
	$index_max = $longueur_tableau - 1;
	
	cree_tableau_indices();
	
	$nbre_passages = 0;
	$tableau_valeurs_possibles[] = $tableau_indices;
	augmente_indice($index_max);
	echo "<pre>";
		print_r($tableau_valeurs_possibles);
	echo "<pre>";
*/
	error_reporting(E_ALL ^ E_NOTICE);

 function array_rand_pick($array, $x)
    {
        $n = count($array) ;
        $set = array( ) ;
        for ( $i = 0 ; $i < $x ; $i++ ) {
            $set[ ] = mt_rand(0, $n - 1) ;
        }
        return $set ;
    }
 
    set_time_limit(100000) ;
    header('Content-Type: text/plain') ;
 
    $tokens = array('0', '1') ;
	$lar = 4;
    $length = $lar*$lar;
    $possibilities = pow(count($tokens), $length) ;
 
    $result = array( ) ;
    $found = 0 ;
 
    while ( $found < $possibilities ) {
        $s = implode('', array_rand_pick($tokens, $length)) ;
        if ( ! in_array($s, $result) ) {
           $result[ ] = $s ;
					$image = imagecreate($lar,$lar);
					$blanc = imagecolorallocate($image, 255, 255, 255);
					$noir = imagecolorallocate($image, 0, 0, 0);
					for ($j = 1; $j <= $length; $j++) {
						if(substr($s,$j,1) == 1)ImageSetPixel($image, $j%$lar, floor($j/$lar), $noir);
					}
					imagejpeg($image, "images$lar/$found.jpeg",100);
            $found++ ;
        }
    }
 
    echo $possibilities, " résultats\r\n\r\n" ;
    sort($result) ;
    print_r($result) ;
	/*
	while ( $i < $possibilities ) {
		$image = imagecreate($lar,$lar);
		$blanc = imagecolorallocate($image, 255, 255, 255);
		$noir = imagecolorallocate($image, 0, 0, 0);
		for ($j = 1; $j <= $length; $j++) {
			if(substr($result[$i],$j,1) == 1)ImageSetPixel($image, $j%$lar, floor($j/$lar)+1, $noir);
		}
		imagegif($image, "images$lar/$i.gif");
		$i++;
	}*/
?>
