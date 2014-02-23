<? 	
	include('fonctions.php');
	$idDec = $_GET['d'];
	if($idDec > 65535 or !is_numeric($idDec)){
		header("Location: 65535.$lan");
	}
	$echoImg ="";
	$result = cas(decbin($idDec),1,0);
	
	foreach ($result as $bin) { // Formes tres proches
		$echoImg .='<a rel="nofollow" href="'.bindec($bin).'.'.$lan.'"><img src="'.mkId($bin).'-8.png" ></a>';
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
		$fProche .= '<a rel="nofollow" href="'.$dto.'.'.$lan.'"><img src="'.mkId(decbin($dto)).'-8.png" ></a>';
	} 
	
	//_______________________________________________________________________________________________________________
	// Formes Aléatoires
	for($is=0;$is<16;$is++){
		$chiffre = rand(1,65536);
		$fAutres .= '<a rel="nofollow" href="'.$chiffre.'.'.$lan.'"><img src="'.mkId(decbin($chiffre)).'-8.png" ></a>';
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
		$date = date('d m Y',$possibleAr['creaU']);
		$maj = date('d m Y - H:i',$possibleAr['updU']);
		$allMiniInfo = $date.' - '.trans($lan,231)." ".$creaBy.' - ( '.trans($lan,232).' : '.$maj.' '.trans($lan,217).' '.$updBy.')';
	} 
	
	//_______________________________________________________________________________________________________________
	// images du possible :
	$tagPossible = tagPossible($idDec,$lan);
	
	$posId .= '
			<div id="posId">
				<h1 id="id">'.$idDec.'</h1>
						<p><img src="'.mkId(decbin($idDec)).'-40.png" ><img src="'.mkId(decbin($idDec)).'-20.png" ><img src="'.mkId(decbin($idDec)).'-8.png" ><img src="'.mkId(decbin($idDec)).'-4.png" ><img src="'.mkId(decbin($idDec)).'-2.png" ><img src="'.mkId(decbin($idDec)).'-1.png"></p>
						<p id="found">'.$allMiniInfo.'</p>
			</div>';
	$rendu .= '<div class="proches">		
					<h2>'.trans($lan,211).'</h2>
							<p class="colone"><img class="imgOn"src="'.mkId(decbin($idDec)).'-8.png" >'.$echoImg.'</p>
					<h2>'.trans($lan,212).'</h2><p class="colone">'.$fProche.'</p>
					<h2>'.trans($lan,213).'</h2><p class="colone">'.$fAutres.'</p>
			</div>
			<div class="proches">
				<h2>'.trans($lan,214).'</h2><p class="colone">'.$tagPossible[0].'</p>
				<h2>'.trans($lan,226).'</h2><p class="colone">'.$tagProcheLoc.'<br />'.$tagProche.'</p>
				<h2>'.trans($lan,227).'</h2><p class="colone">'.$tagPossible[1].'</p>
				<!--<p class="colone"><a href="#"><img src="../medias/images/fr.png"></a><a href="#"><img src="../medias/images/es.png"></a><a href="#"><img src="../medias/images/en.png"></a><a href="#"><img src="../medias/images/de.png"></a></p>-->
			</div>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<? echo cleanTitre($tagPossible["0"].$tagPossible["1"].$tagProche.$tagProcheLoc)?>">
<meta http-equiv="content-language" content="<? echo $lan; ?>">
<meta name="description" content="<? 
$motsDescription = ucfirst(strtolower(str_replace(","," ",str_replace(" ","",cleanTitre($tagPossible["0"].$tagPossible["1"].$tagProche.$tagProcheLoc)))));
echo trans($lan,100).' '.$motsDescription.'- '.ucfirst(trans($lan,218)).' / '.strtolower(trans($lan,220)).', '.cleanTitre($allMiniInfo);?>">

<? if(cleanTitre($creaBy)!="")$auteurTitre = strtolower(trans($lan,231)).' '.cleanTitre($creaBy).'.';?>

<title><? echo ucfirst(cleanTitre($tagPossible["0"].$tagPossible["1"])).' '.trans($lan,111).' n° '.$idDec.', '.$auteurTitre;?></title>

<style>body {background:url(<? echo mkId(decbin($idDec)).'-1.png';?>);}</style>

<link rel="stylesheet" type="text/css" href="layout.css">
<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
<link rel="shortcut icon" href="<? echo mkId(decbin($idDec)).'-4.png'; ?>" type="image/x-icon" />
<link rel="icon" type="image/png" href="<? echo mkId(decbin($idDec)).'-4.png'; ?>" />

</head>
<body>
<? if(isset($posId))echo $posId ?>
<div id="cont">
  <? if(isset($rendu))echo $rendu ?>
  <div class="proches">
    <h2><? echo trans($lan,215) // Ajouter des tags?></h2>
    <form class="colone" action="addTag.<? echo $lan ?>" method="post">
      <? echo trans($lan,216) ?><br />
      <textarea name="tag" rows="5" id="tag"><? echo $tagPossible["0seul"] ?></textarea>
      <input name="idDec" type="hidden" value="<? echo $idDec ?>" />
      <input name="lan" type="hidden" value="<? echo $lan ?>" />
      <? echo trans($lan,217) ?><br />
      <input name="by" type="text" id="by" value="<? echo $_COOKIE['by'] ?>" />
      www<br />
      <input name="bySite" type="text" id="bySite" value="<? echo $_COOKIE['bySite'] ?>" />
      <input name="funtst" type="hidden" id="funtst" value="" />
      <input name="Ajouter" type="submit" id="edit" value=" <? echo trans($lan,228) ?>" />
    </form>
    <h2><a href="words.<? echo $lan;?>"><? echo trans($lan,219) //Top Mots ?></a></h2>
    <p class="colone"><? echo meilleursMots()?></p>
    <h2><a href="*.<? echo $lan;?>"><? echo trans($lan,223)// Découvertes récentes?></a></h2>
    <p class="colone"><? echo dernierDecouverte()?></p>
  </div>
  <? include('../pages/find.php'); ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1651183-8";
urchinTracker();
</script>
<? include('../../../credit.php') ?>


</body>
