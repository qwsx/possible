<style>
body {
background-image:url(
<? include('../machine/fonctions.php'); 

$sql1 = mysql_query("SELECT * FROM `possibleTag`");

$randResult = rand(1,mysql_num_rows($sql1));

$sql2 = mysql_query("SELECT * FROM `possibleTag` LIMIT $randResult , 1");
$arr1 = mysql_fetch_array($sql2);

		$chiffre = $arr1['idDec'];
		$taille = (rand(0,10)*10)+1;
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
font-family:Arial, Helvetica, sans-serif;}
a {
text-decoration:none;
color:#FF0000;
border:none;
}
img {
border:none;
}
</style>
<meta http-equiv="refresh" content="<? echo $_GET['r']; ?>";>
<body><a href="?r=">[ ]</a>
<?
$tagPossible = tagPossible($chiffre,"fr");
echo '<h1><a href="../'.$chiffre.'.fr"><img src="'.$fAutres2.'"></a> this is  <strong>'.$tagPossible[0].$tagPossible[1].'</strong></h1>';

?>

</body>
