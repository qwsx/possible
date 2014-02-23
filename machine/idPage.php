<? 	
	include('_fonctions.php');
	$idDec = $_GET['d'];
	if($idDec > 65535 or !is_numeric($idDec)) header("Location: 65535.$lan");
	
	$echoImg ="";
	$result = cas(decbin($idDec),1,0);
	
	foreach ($result as $bin) { // Formes tres proches
		$echoImg .='<a href="'.bindec($bin).'.'.$lan.'"><img src="'.mkId($bin).'-9-0.png" ></a>';
		$tagPossible = tagPossible(bindec($bin),$lan);
		$tagProcheLoc .= $tagPossible[0];
		$tagProche .= $tagPossible[1];
	} 
	
	//_______________________________________________________________________________________________________________
	// Formes proches
	for($is=1;$is<17;$is++){
		if($idDec<8){$mf=+1;};
		if($idDec>65526){$mf=-17;};
		$dto = $idDec+$is+$mf;
		$fProche .= '<a href="'.$dto.'.'.$lan.'"><img src="'.mkId(decbin($dto)).'-9-0.png" ></a>';
	} 
	
	//_______________________________________________________________________________________________________________
	// Formes Aléatoires
	for($is=0;$is<16;$is++){
		$chiffre = rand(1,65536);
		$fAutres .= '<a href="'.$chiffre.'.'.$lan.'"><img src="'.mkId(decbin($chiffre)).'-9-0.png" ></a>';
	} 
	
	//_______________________________________________________________________________________________________________	
	// Info du possible
	$possibleAr = mysql_fetch_array(mysql_query("SELECT *,UNIX_TIMESTAMP(crea) as creaU ,UNIX_TIMESTAMP(upd) as updU FROM `possible` WHERE `idDec` = $idDec"));
	if(mysql_affected_rows()){ 
		if($possibleAr['creaBySite'] == ""){$possibleAr['creaBySite'] = '#';}else{$possibleAr['creaBySite'] = 'http://'.$possibleAr['creaBySite'];}
		if($possibleAr['creaBy'] == "")$possibleAr['creaBy'] = 'Anonymous';
		if($possibleAr['updBySite'] == ""){$possibleAr['updBySite'] = '#';}else{$possibleAr['updBySite'] = 'http://'.$possibleAr['updBySite'];}
		if($possibleAr['updBy'] == "")$possibleAr['updBy'] = 'Anonymous';
		
		$creaBy = '<a href="'.$possibleAr['creaBySite'].'" target="_blank">'.$possibleAr['creaBy'].'</a>';
		$updBy = '<a href="'.$possibleAr['updBySite'].'" target="_blank">'.$possibleAr['updBy'].'</a>';
		$date = date('d.m.Y',$possibleAr['creaU']);
		$maj = date('d.m.Y',$possibleAr['updU']);
		$allMiniInfo = $date.'<br>'.trans($lan,231)." ".$creaBy.'<br>-<br>'.$maj.'<sup> '.trans($lan,232).'</sup><br>'.$updBy;
	} 
	
	//_______________________________________________________________________________________________________________
	// images du possible :
	$tagPossible = tagPossible($idDec,$lan);
	//print_r($tagPossible);	
	$rendu .= '<section class="col">		
				<aside><h2>'.trans($lan,211).'</h2><p class="gird"><a class="imgOn" href="#"><img src="'.mkId(decbin($idDec)).'-9-0.png" ></a>'.$echoImg.'</aside>
				<aside><h2>'.trans($lan,212).'</h2><p class="gird">'.$fProche.'</aside>
				<aside><h2>'.trans($lan,213).'</h2><p class="gird">'.$fAutres.'</aside>
			</section>
			<section class="col">
				<aside><h2>'.trans($lan,214).'</h2><p class="list">'.$tagPossible[0].'</p></aside>
				<aside><h2>'.trans($lan,226).'</h2><p class="list">'.$tagProcheLoc.''.$tagProche.'</p></aside>
				<aside><h2>'.trans($lan,227).'</h2><p class="list">'.$tagPossible[1].'</p></aside>
			</section>';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset=utf-8 />
		<meta name="keywords" content="<?=cleanTitre($tagPossible["0"].$tagPossible["1"].$tagProche.$tagProcheLoc)?>">
		<meta http-equiv="content-language" content="<? echo $lan; ?>">
		<meta name="description" content="<? $motsDescription = ucfirst(strtolower(str_replace(","," ",str_replace(" ","",cleanTitre($tagPossible["0"].$tagPossible["1"].$tagProche.$tagProcheLoc)))));echo trans($lan,100).' '.$motsDescription.'- '.ucfirst(trans($lan,218)).' / '.strtolower(trans($lan,220)).', '.cleanTitre($allMiniInfo);?>">
		<? if(cleanTitre($creaBy)!="")$auteurTitre = strtolower(trans($lan,231)).' '.cleanTitre($creaBy).'.';?>

		<title><? echo ucfirst(cleanTitre($tagPossible["0"].$tagPossible["1"])).' '.trans($lan,111).' n° '.$idDec.', '.$auteurTitre;?></title>

		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
		<link rel="shortcut icon" href="<? echo mkId(decbin($idDec)).'-4.png'; ?>" type="image/x-icon" />
		<link rel="icon" type="image/png" href="<? echo mkId(decbin($idDec)).'-4.png'; ?>" />
		
		<link rel="stylesheet" type="text/css" href="css/ui-custom-theme/jquery-ui-1.8.18.custom.css">
		<script type="text/javascript" src="machine/_lib/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="machine/_lib/jquery-ui-1.8.18.custom.min.js"></script>
		<?php include('_lib/search-autocomplete.php'); ?>
		
		<script type="text/javascript" src="machine/_lib/jqtags/jtags.js"></script>
		<script>$(function(){$('.tag').tags({'separator':' '});});</script>
		
	</head>
	<body style="background-image:url(<?=mkId(decbin($idDec)).'-9-0.png';?>);">
	<? include('media/pages/langueSw.php'); ?>	

	<div id="page">
		<section id="posId">
		<? echo  '	<aside><img src="'.mkId(decbin($idDec)).'-47.png" ></aside>
					<aside><h1 id="id">&#8470; '.$idDec.'</h1><p id="found">'.$allMiniInfo.'</p>';
					?>
					<p>-<br>
					<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php 
//echo 'http://possible.dcfvg.com/'.mkId(decbin($idDec)).'-100.png = ';
echo $tagPossible["hashTag"]."?";
					
					
					?>" data-via="dcfvg">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
			</aside>

		</section>
		<div id="cont">
			<?=$rendu?>
			
			<section class="col">
				<div class="formulaire">
					<h2><?= trans($lan,216) ?></h2>
					<? include('form.php'); ?>
				</div>
				<aside class="extended" >
					<h2><? echo trans($lan,219) //Top Mots ?></h2>
					<p class="list">
					<? print_r(meilleursMots())?></p>
				</aside>
			</section>
			<section class="col">
				<? include('media/pages/find.php'); ?>						
				<aside><h2><? echo trans($lan,223)// Découvertes récentes?></h2><p class="gird"><? echo dernierDecouverte()?><a class="suite" href="*.<? echo $lan;?>">…</a></p></aside>


			</section>
		</div>	
	 </div>
	 <? include('media/pages/analytics.php'); ?>	
	</body>
	
</html>
