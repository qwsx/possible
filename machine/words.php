<?
header('Content-type: text/html; charset=UTF-8'); 
include('_fonctions.php');
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
	<link rel="stylesheet" type="text/css" href="css/style.css">

		<link rel="stylesheet" type="text/css" href="css/ui-custom-theme/jquery-ui-1.8.18.custom.css">
		<script type="text/javascript" src="machine/_lib/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="machine/_lib/jquery-ui-1.8.18.custom.min.js"></script>
		<?php include('_lib/search-autocomplete.php'); ?>
		
	<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
	<link rel="shortcut icon" href="f99b-4.png" type="image/x-icon" />

	<title><? echo ucwords($tag).' | '.trans($lan,111).' | '.cleanTitre($autour[$lan])?> </title>
</head>

<body id="words">
<? include('media/pages/langueSw.php'); ?>	
<div id="page">
	<section id="posId">
  		<h1 class="txt"><? echo $tag?> <sup><? echo $possibleTag['lan']?></sup></h1>
	</section>
	<div id="cont">
  		<section class="col" >
    		<aside>
    		<h2>Possibles</h2>
    		<p class="gird"><? echo $possibleTag['img']?></p>
    		</aside>
 		</section>
 		<section class="col">
 			<aside>
    			<h2><? echo trans($lan,226) //voir aussi ?></h2>
    			<p class="list"><? echo $autour[$lan]?></p>
    		</aside>
    		<aside>
    		    <h2><? echo trans($lan,212) // proches ?></h2>
    			<p class="list"><? echo $possibleTag[$lan]?></p>
    		</aside>
    		<aside>
    		 <h2><? echo trans($lan,227) // Autres langues ?></h2>
   			<p class="list">
   	<? 
   	if($lan=='fr') echo $possibleTag['en'].$possibleTag['es'].$possibleTag['de'].$autour['en'].$autour['de'].$autour['es'];
	if($lan=='en') echo $possibleTag['fr'].$possibleTag['es'].$possibleTag['de'].$autour['fr'].$autour['de'].$autour['es'];?>
    		</p>
    		</aside>

    	</section>
  		<section class="col" >
			<aside><h2><? echo trans($lan,223)// Découvertes récentes?></h2><p class="gird"><? echo dernierDecouverte()?><a class="suite" href="*.<? echo $lan;?>">…</a></p></aside>
    		<aside>
    			<h2><? echo trans($lan,219) //Top Mots ?></h2>
    			<p class="list"><? echo meilleursMots()?></p>
    		</aside>
    	</section>
		<section class="col">
			<? include('media/pages/find.php'); ?>						
		</section>
	</div>
</div>
<? include('media/pages/analytics.php'); ?>	
</body>
</html>