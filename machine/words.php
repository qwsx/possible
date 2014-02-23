<?
header('Content-type: text/html; charset=UTF-8'); 
include('fonctions.php');
$tag = strtolower($_GET['mot']);

$possibleTag = possibleTag($tag);
$autour = motAutours($tag);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<? echo cleanTitre($autour[$lan])?>">
<meta http-equiv="content-language" content="<? echo $lan; ?>">
<link rel="stylesheet" type="text/css" href="layout.css">
<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
<link rel="shortcut icon" href="f99b-4.png" type="image/x-icon" />

<title><? echo ucwords($tag).' | '.trans($lan,111).' | '.cleanTitre($autour[$lan])?> </title>
</head>
<body>
<div id="posId">
  <h1 class="txt"><? echo $tag?> <sup><? echo $possibleTag['lan']?></sup></h1>
</div>
<div id="cont">
  <div class="proches" >
    <h2>Possibles</h2>
    <p class="coloneL"><? echo $possibleTag['img']?></p>
  </div>
  <div  class="proches" >
    <h2><a href="words.fr" ><? echo trans($lan,226) //voir aussi ?></a></h2>
    <p class="colone"><? echo $autour[$lan]?></p>
    <h2><? echo trans($lan,212) // proches ?></h2>
    <p class="colone"><? echo $possibleTag[$lan]?></p>
    <h2><? echo trans($lan,227) // Autres langues ?></h2>
    <p class="colone">
   	<? 
	if($lan=='fr') echo $possibleTag['en'].$possibleTag['es'].$possibleTag['de'].$autour['en'].$autour['de'].$autour['es'];
	if($lan=='en') echo $possibleTag['fr'].$possibleTag['es'].$possibleTag['de'].$autour['fr'].$autour['de'].$autour['es'];
	if($lan=='es') echo $possibleTag['en'].$possibleTag['fr'].$possibleTag['de'].$autour['en'].$autour['de'].$autour['fr'];
	if($lan=='de') echo $possibleTag['en'].$possibleTag['es'].$possibleTag['fr'].$autour['en'].$autour['fr'].$autour['es'];

	?>
    </p>
  </div>
    <div class="proches">
    <h2><a href="*.<? echo $lan;?>"><? echo trans($lan,223)// Découvertes récentes?></a></h2>
    <p class="colone"><? echo dernierDecouverte()?></p>
    <h2><a href="words.<? echo $lan;?>"><? echo trans($lan,219) //Top Mots ?></a></h2>
    <p class="colone"><? echo meilleursMots()?></p>
    <?
	for($is=0;$is<16;$is++){// Formes Aléatoires
		$chiffre = rand(1,65536);
		$fAutres .= '<a rel="nofollow" href="'.$chiffre.'.'.$lan.'"><img src="'.mkId(decbin($chiffre)).'-8.png" ></a>';
	}	
	echo '<h2>'.trans($lan,213).'</h2><p class="colone">'.$fAutres.'</p>'; ?>
  </div>

  <? include('../pages/find.php'); ?>
</div>
</body>
</html>