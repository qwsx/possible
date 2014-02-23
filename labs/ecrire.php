<?
include('../machine/_fonctions.php');

function wordToPos($word,$taille,$ordre) {
	$word = strtolower($word);
	for($i=0; $i < strlen($word) ;$i++){
		
		$sql[0] = "SELECT * FROM  `possibleTag` WHERE  `tag` LIKE  '".$word[$i]."' ORDER BY  `possibleTag`.`nb` DESC LIMIT 0 , 1 ";
		$sql[1] = "SELECT * FROM  `possibleTag` WHERE  `tag` LIKE  '".$word[$i]."' ORDER BY RAND() LIMIT 0 , 1 ";
		$result = mysql_fetch_array(mysql_query($sql[$ordre]));
		$lan = $result['lan'];
		$idDec = 1632;
		if($result['idDec'] >0)$idDec = $result['idDec'];
		if($word[$i] == " ") $idDec = 65535; 
		$res .= '<a href="../'.$word[$i].'.txt"><img src="../'.mkId(decbin($idDec)).'-'.$taille.'.png" ></a>';
		$result['idec'];
	}
	return $res ;
}
$taille = 10;
$tailleSml = 1;
$ordre = 1;
$word = "the quick brown fox jumps over the lazy dog 12345678910 -+/*=";
if(isset($_POST['word']))$word = $_POST['word'];
if(isset($_POST['taille']))$taille = $_POST['taille'];
if(isset($_POST['tailleSml']))$tailleSml= $_POST['tailleSml'];
echo "<p>".wordToPos($word,$taille,$ordre)."</p>";
echo "<p>".wordToPos($word,$taille,0)."</p>";
function allLetterPos($letter){
	$sql = "SELECT * FROM  `possibleTag` WHERE  `tag` LIKE  '".$letter."' ORDER BY  `possibleTag`.`nb` DESC";
	
	while($result = mysql_fetch_array($sql)){
					$res .= '<a href="../'.$word[$i].'.txt"><img src="../'.mkId(decbin($idDec)).'-'.$taille.'.png" ></a>';

	}
	
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
}
p {
padding:30px;}
p img {
 margin:<? echo $taille*2 ?>px 0 0 <? echo $taille ?>px;
}
.sml img {
	 margin:<? echo $tailleSml*2 ?>px 0 0 <? echo $tailleSml ?>px;

}
</style>
<body>
<br />
<br />
<form action="" method="post">
  <p class="sml"> <? echo wordToPos($word,$tailleSml,0); ?> </p>
  <p>
    <textarea name="word" cols="80" rows="5"><? echo $word ?></textarea>
    <input name="taille" type="text" value="<? echo $taille?>" /><input name="tailleSml" type="text" value="<? echo $tailleSml?>" />
    <input name="ecrire" type="submit" value="ok !" />
  </p>
</form>
</body>
</html>
