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
        		   // $result[ ] = $s ;
					$image = imagecreate($lar,$lar);
					$blanc = imagecolorallocate($image, 255, 255, 255);
					$noir = imagecolorallocate($image, 0, 0, 0);
					for ($j = 0; $j <= $length; $j++) {
						if(substr($s,$j,1) != 1)ImageSetPixel($image, $j%$lar, floor($j/$lar), $noir);
					}
					imagejpeg($image, "images$lar/$s.jpeg",100);
            $found++ ;
        }
    }
 
    echo $possibilities, " résultats\r\n\r\n" ;
    //sort($result) ;
    //print_r($result) ;
?>
