<?
include('../machine/_fonctions.php');


function allLetterPos($letter){
	$sql = mysql_query("SELECT * FROM  `possibleTag` WHERE  `tag` LIKE  '".$letter."' ORDER BY  `possibleTag`.`nb` DESC");
	$taille = 4;
	
	while($result = mysql_fetch_array($sql)){
					$idDec = $result['idDec'];
					$res .= '<a href="../'.$idDec.'.fr"> <img src="../'.mkId(decbin($idDec)).'-'.$taille.'.png" > </a><br /><br />';

	}
	return $res;
}
$word = "the quick brown fox jumps over the lazy dog 12345678910 -+/*=";
	$word = strtolower($word);
	for($i=0; $i < strlen($word) ;$i++){
		
		$toEcho .= '<div>&nbsp;<br /><br />'.allLetterPos($word[$i]).'</div>';
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Document sans nom</title>
</head>
<style>
* {
	margin:0;
	padding:0;
}
body {
	background:#F5F5F5;
	padding:50px;
}
p {}
p img {
 margin:<? echo $taille*2 ?>px 0 0 <? echo $taille ?>px;
}
div {float:left;
font-size:9px;
font-family:Arial, Helvetica, sans-serif;
}
</style>
<body>
  <p>
  	<? echo $toEcho; ?> 
  </p>
</body>
</html>
