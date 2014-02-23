<?php
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(0);

//....................................................................
function convert_sec ($time) {
	$output = '';
	$tab = array ('j' => '86400', 'h' => '3600', 'm' => '60', 's' => '1');
	foreach ($tab as $key => $value) {
		$compteur = 0;
		while ($time > ($value-1)) {
			$time = $time - $value;
			$compteur++;
		}
		if ($compteur != 0) {
			$output .= $compteur.''.$key;
			if ($value != 1) $output .= ' ';
		}
	}
	return $output;
}

//....................................................................
function timeLauched ($start){
	$end = time();
	$tempgen = round(($end - $start), 2);
	return convert_sec($tempgen);
}

//....................................................................
function mkId($pos){
	return dechex(bindec($pos));
}

//....................................................................
function trId($id){
	return str_pad(decbin(hexdec($id)), 16, "0", STR_PAD_LEFT);
}

//....................................................................
function f16($chiffre) {
	return str_pad($chiffre, 16, "0", STR_PAD_LEFT);
}
//....................................................................
function f4($chiffre) {
	return str_pad($chiffre, 4, "0", STR_PAD_LEFT);
}
//....................................................................
function neg($b){
	return str_replace("a","1",str_replace("1","0",str_replace("0","a",f16($b))));
}
//....................................................................
function lineList($c){
	$c = f16($c);
	$list[0] = $c;
	for($i=0;$i<4;$i++){
		$list[$i+1] = substr($c,$i*4,4);
		$list[$i+5] = substr($c,$i,1).substr($c,4+$i,1).substr($c,8+$i,1).substr($c,12+$i,1);
	}
	return $list;
}

//....................................................................
function rot180($list){
	return strrev($list[1].$list[2].$list[3].$list[4]) ;
}

//....................................................................
function rotM90($list){
	return strrev($list[5]).strrev($list[6]).strrev($list[7]).strrev($list[8]);
}

//....................................................................
function rotP90($list) {
	return $list[8].$list[7].$list[6].$list[5];
}

//....................................................................
function symVer($list){
	return strrev($list[1]).strrev($list[2]).strrev($list[3]).strrev($list[4]);
}
//....................................................................
function symHor($list){
	return strrev(strrev($list[1]).strrev($list[2]).strrev($list[3]).strrev($list[4]));
}
//....................................................................
function symHorRotM90($list){
	return strrev($list[8]).strrev($list[7]).strrev($list[6]).strrev($list[5]);
}
//....................................................................
function symHorRotP90($list){
	return $list[5].$list[6].$list[7].$list[8];
}
//....................................................................
function cas($d,$negs,$supPr) {
	$put=0;
	$list = lineList($d);
	$c = bindec($d);
	$result = array();
	$preResult[0] = rot180($list);
	$preResult[1] = symVer($list);
	$preResult[2] = symHor($list);
	$preResult[3] = rotP90($list);
	$preResult[4] = rotM90($list);
	$preResult[5] = symHorRotM90($list);
	$preResult[6] = symHorRotP90($list);
	if($negs){
		$preResult[7] = neg($d);
		$preResult[8] = neg($preResult[0]);
		$preResult[9] = neg($preResult[1]);
		$preResult[10] = neg($preResult[2]);
		$preResult[11] = neg($preResult[3]);
		$preResult[12] = neg($preResult[4]);
		$preResult[13] = neg($preResult[5]);
		$preResult[14] = neg($preResult[6]);
	}
	foreach ($preResult as $bin) {
		if($supPr){
			if(bindec($bin)<$c){
				if (!in_array($bin, $result) ) {
					$result[ ] = $bin;
				}
			}
		}else{
			if (!in_array($bin, $result) and bindec($bin) != $c) {
					$result[ ] = $bin;
			}
		}
	}	
	return $result;
}
/*
function existe ($c) {
	$result = cas($c);
	$ex = true;
	foreach ($result as $bin) {
				if(bindec($bin)>$c)$ex=false;
	}
	return $ex;
}*/
?>
