<?
include('machine/bdd.php');
include('machine/fonctions.php');

$sql1 = mysql_query("SELECT * FROM `possibleTag`");
$randResult = rand(1, mysql_num_rows($sql1));
$sql2 = mysql_query("SELECT * FROM `possibleTag` LIMIT $randResult , 1");
$arr1 = mysql_fetch_array($sql2);
$chiffre = $arr1['idDec'];
$taille = (rand(0, 10)*10)+1;
$fond .= '../'.mkId(decbin($chiffre)).'-1.png';
$fAutres .= '../'.mkId(decbin($chiffre)).'-8.png';
 
$Rnb1 = mysql_num_rows(mysql_query("SELECT * FROM `possible`"));
$Rchiffre = rand(1,65536);
$Rpourcent = round(($Rnb1/65536)*100,3);
$RfAutres .= '../'.mkId(decbin($Rchiffre)).'-8.png';

$tagPossible = tagPossible($chiffre,"fr");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="layout.css">
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? if(!isset($_GET['mode']))echo '<meta http-equiv="refresh" content="4";>'; ?>
<title>Possible ? The all 4x4 images collection to describe ... <? echo $tagPossible['0v'].$tagPossible['1v'] ?></title>
<style>body {background-image:url(<? echo $fond?> );}</style>
</head>
<body>
<div id="cont" >
  <div class="elem">
    <h1 id="top"><img src="http://possible.versatile.fr/f337-14.png"><img src="http://possible.versatile.fr/f151-14.png"><img src="http://possible.versatile.fr/f9b3-14.png"><img src="http://possible.versatile.fr/f9b3-14.png"><img src="http://possible.versatile.fr/ffbb-14.png"><img src="http://possible.versatile.fr/f311-14.png"><img src="http://possible.versatile.fr/f771-14.png"><img src="http://possible.versatile.fr/f731-14.png"></h1>
    <h4>- The 65 536 <img src="750d-2.png" /> <img src="f5b5-2.png" /> <img src="750d-2.png" /> pixels images directory -</h4>
  </div><p class="message">Maintenance &#8212; Read Only Mode !</p>
  <?
echo '
<div  class="elem">
	<div class="thmb"><img src="'.$RfAutres.'"></div>
	<h1><span>'.$Rpourcent.'</span>% of the shape was described</h1>
	<p><a rel="nofollow" href="'.$Rchiffre.'.fr">'.$GLOBALS['fr'][101].'</a> · <a rel="nofollow" href="'.$Rchiffre.'.en">'.$GLOBALS['en'][101].'</a> · <a rel="nofollow" href="'.$Rchiffre.'.de">'.$GLOBALS['de'][101].'</a> · <a rel="nofollow" href="'.$Rchiffre.'.es">'.$GLOBALS['es'][101].'</a></p>
</div>

<div class="elem">
	<div class="thmb"><img src="'.$fAutres.'"></div>
	<h1> this is  '.strip_tags($tagPossible[0].$tagPossible[1],"<sup>").'</h1>
	<p><a href="'.$chiffre.'.fr">'.$GLOBALS['fr'][100].'</a> · <a href="'.$chiffre.'.en">'.$GLOBALS['en'][100].'</a> · <a href="'.$chiffre.'.de">'.$GLOBALS['de'][100].'</a> · <a href="'.$chiffre.'.es">'.$GLOBALS['es'][100].'</a></p>
</div>
';
?>
<!--<h5 style="text-align:center;margin-top:20%;"><img src="http://possible.versatile.fr/f337-14.png"><img src="http://possible.versatile.fr/f151-14.png"><img src="http://possible.versatile.fr/f9b3-14.png"><img src="http://possible.versatile.fr/f9b3-14.png"><img src="http://possible.versatile.fr/ffbb-14.png"><img src="http://possible.versatile.fr/f311-14.png"><img src="http://possible.versatile.fr/f771-14.png"><img src="http://possible.versatile.fr/f731-14.png"></br></br> maintenance … </h5>-->

</div>
<? include('../../credit.php') ?>

</body>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1651183-8";
urchinTracker();
</script>
