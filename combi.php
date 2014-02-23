<?php
set_time_limit(100000) ;
function combinaisons($longueur){
	$limite = pow( 2, $longueur );
	$valeurs = array();
	for( $i=0; $i<$limite; $i++ ){
		$valeurs[] = str_pad( base_convert( $i, 10, 2 ), $longueur, '0', STR_PAD_LEFT );
	}
	return $valeurs;
}
 
$valeurs = combinaisons(16);
foreach( $valeurs as $v ){
	print $v.'<br />';
}
 
?>