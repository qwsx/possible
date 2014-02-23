<?php
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
    //header('Content-Type: text/plain') ;
 
    $tokens = array('0', '1') ;
	$margin = 2;
	$lar = 3;
    $length = $lar*$lar;
    $possibilities = pow(count($tokens), $length) ;
 	$tailleRendu = 500;
    $result = array( );
    $found = 0 ;
 	$image = imagecreate($tailleRendu,$tailleRendu);
	$blanc = imagecolorallocate($image, 200, 200, 200);
	$col["0"] = imagecolorallocate($image, 0, 0, 0);
	$col["1"] = imagecolorallocate($image, 255, 255, 255); 
    while ( $found < $possibilities ) {
        $s = implode('', array_rand_pick($tokens, $length)) ;
        if ( ! in_array($s, $result) ) {
				echo $found."-";
				echo $adix = $margin/2+($margin+$lar)*($found%$tailleRendu);echo":";
				echo $adiy = $margin/2+($margin+$lar)*floor($found-1/$tailleRendu);echo"<br>";
        		$result[ ] = $s ;
			for ($j = 0; $j < $length; $j++) {
					ImageSetPixel($image, ($j%$lar)+$adix, floor($j/$lar)+$adiy, $col[substr($s,$j,1)]);
			}
				$found++ ;
        }
		
    }
	imagejpeg($image, "images$lar/all$lar.jpeg",100);
	echo '<img src="images'.$lar.'/all'.$lar.'.jpeg"  width="'.(2*$tailleRendu).'" height="'.(2*$tailleRendu).'">';
	    echo $possibilities, " résultats\r\n\r\n" ;

    //sort($result) ;
    //print_r($result) ;
?>
