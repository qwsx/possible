<style>
body {
background-image:url(
<? include('../machine/fonctions.php');
$nb1 = mysql_num_rows(mysql_query("SELECT * FROM `possibleTag`"));
		$chiffre = rand(1,65536);
		$taille = (rand(0,10)*10)+1;
		$pourcent = round(($nb1/65536)*100,4);
		echo $fAutres .= '../'.mkId(decbin($chiffre)).'-1.png';
				$fAutres2 .= '../'.mkId(decbin($chiffre)).'-20.png';

?>
);

}
h1 {
font-size:40px;
background:#FFFFFF;
padding:40px;
margin:20px;
position:absolute;
top:20%;
font-family:Arial, Helvetica, sans-serif;
text-decoration:blink;}
a {
text-decoration:none;
color:#FF0000;
border:none;
}
img {
border:none;
}

</style>
<? $tagPossible = tagPossible($chiffre,"fr");
if($tagPossible[0] != "") {
	$timer = 10;
	$etat = "This is";
}else{
	$timer = $_GET['r'];
	$etat = "Scan ... <a href=\"../$chiffre.fr\">#$chiffre</a>/65536 - $pourcent%";
	}
?>
<meta http-equiv="refresh" content="<? echo $timer ?>";>
<body>
<?

echo '<h1><a href="../'.$chiffre.'.fr"><img src="'.$fAutres2.'"></a> '.$etat.' '.$tagPossible[0]."</h1>";

?>
</body>
