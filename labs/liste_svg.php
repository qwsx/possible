<? include('../machine/_fonctions.php'); 
$sql2 = mysql_query("SELECT * , COUNT( * ) AS somme FROM `possible` GROUP BY `idDec` ORDER BY `idDec` ASC");

		while($arr1 = mysql_fetch_array($sql2)){
			$chiffre = $arr1['idDec'];
			$tagPossible = tagPossible($chiffre,"fr");
			
			$svg = idToSvg(decbin($chiffre),4).'  ';
			$tags= $tagPossible[0].$tagPossible[1];
			if($tags != "") echo '<h1>'.$svg.' this is  <strong>'.$tagPossible[0].$tagPossible[1].'</strong></h1>';
			$i++;
		}
echo $i;
?>
<style>
*{
	font-family:Arial, Helvetica, sans-serif;
	font-size:9px;
	font-weight:lighter;
}
	
h1 {

width:16%;
float:left;
font-weight:lighter;
overflow:hidden;
height:19px;
}
a {
text-decoration:none;
color:#000;
}
img {
border:none;
margin-right:8px;

}
</style>
