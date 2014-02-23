<? 	


	include('fonctions.php');
	if(isset($_GET['b'])){
		$d = bindec($_GET['b']);
	}else{
		$d = $_GET['d'];
	}
	$echoImg ="";
	$result = cas(decbin($d),1,0);
	echo '<h1>N° '.$d." - ".count($result).'</h1><p>';
	foreach ($result as $bin) {
		$echoImg .='<a href="?d='.bindec($bin).'"><img src="cas.php?nombre='.bindec($bin).'" width="30" height="30"></a>';
	}	
	echo '<img src="cas.php?nombre='.$d.'" width="160" height="160">';
	echo '<img src="cas.php?nombre='.$d.'" width="40" height="40">';
	echo '<img src="cas.php?nombre='.$d.'" width="10" height="10"><h2>Formes tres proches</h2><p class="colone">
	<img class="imgOn"src="cas.php?nombre='.$d.'" width="30" height="30">'.$echoImg.'</p><h2>Formes proches</h2><p class="colone">';
	for($is=0;$is<16;$is++){
		if($d>8){$mf=-8;};
		$dto = $d+$is+$mf;
		echo '<a href="?d='.$dto.'"><img src="cas.php?nombre='.$dto.'" width="30" height="30"></a>';
	}
	echo '<h2>Autre formes</h2><p class="colone">';
	for($is=0;$is<16;$is++){
		$chiffre = rand(1,65536);
		echo '<a href="?d='.$chiffre.'"><img src="cas.php?nombre='.$chiffre.'" width="30" height="30"></a>';
	}
	echo '</p>';
?>

<p class="recherche">
  <object type="application/x-shockwave-flash" data="Sans nom-1.swf" width="240" height="200">
    <param name="movie" value="Sans nom-1.swf" />
    texte alternatif
  </object>
</p>
<h2>See also</h2>
<p> Adrian frutiger (L'homme et ses signes http://www.autremonde.fr/images/products_040359.jpg)<br>
  Norm ( the things http://www.norm.to/pages/generator_3.html)<br>
  Pierre di scullo ( 3x3 type http://www.quiresiste.com/projet.php?id_projet=52&lang=fr&id_gabarit=0 )<br>
  SuperScript ( wallpaper http://www.super-script.com/projets/wallpaper/index.php )<br>
  Traffik ( collecto http://www.collekto.org/lecube/index-fr.html)<br>
  bitFontmaker ( http://www.pentacom.jp/soft/ex/font/edit.html)<br>
</p>
<style>
img {
margin:5px;
border:1px solid #E0E0E0;
}
img:hover,.imgOn  {
	border-color:#000;
}
*{
margin:0px;
padding:0px;
}
h1{
font-family:Arial, Helvetica, sans-serif;
font-size:60px;
letter-spacing:-5px;
}
h2 {
	font-family:Arial, Helvetica, sans-serif;
	font-size:10px;
	margin-left:225px;
	margin-top:30px;

}
.recherche {

position:absolute;
left:500px;
top:60px;
}
.colone{
width:175px;
height:160px;
margin-left:225px;

}
p {
margin-left:50px;
font-size:9px;
font-family:Arial, Helvetica, sans-serif;
}
</style>
