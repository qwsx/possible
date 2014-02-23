<?php
header('Content-type: text/html; charset=UTF-8');
include('_fonctions.php');
$input = explode("-",$_GET['page']);

$page = $input[0];
$param = $input[1];

include('rcaptcha-key.php');
$resp = null;
$error = null;

if ($_POST["recaptcha_response_field"]) {
    $resp = recaptcha_check_answer ($privatekey,
        $_SERVER["REMOTE_ADDR"],
        $_POST["recaptcha_challenge_field"],
        $_POST["recaptcha_response_field"]);
}
	
switch($page)
{
case'seeAlso':$toInc = "also.php";break;
case'addTag':
	$idDec = $_POST['idDec'];
	$lan = $_POST['lan'];
	$by = $_POST['by'];
	$bySite = str_replace('http://',"",$_POST['bySite']);
	$tags =  strtolower(str_replace("  ", " ",$_POST['tag']));
	
	setcookie('tags'.$idDec,$tags, (time() + 36000000 ));
	setcookie("error-$idDec");
	if($resp->is_valid){
		if($_COOKIE["ajouts-$idDec"]==""){
		
			
			
			
			updatePos($idDec,$lan,$by,$bySite);
			updateTag($idDec,strip_tags($tags),$lan);
			setcookie('tags');
			setcookie("ajouts-$idDec","1", (time() + 30));
		}
	}else{
		$so ="?error=cap";
		setcookie("error-$idDec","cap",(time() + 36000000));
	}
	
	setcookie('by',$by, (time() + 36000000 ));
	setcookie('bySite',$_POST['bySite'], (time() + 36000000 ));
	header("Location: $idDec.$lan".$so);
	break;
case'search':
	$mot = $_POST['query'];
	header("Location: $mot.txt");
	break;
case'*':
	
	$title = trans($lan,223);
	
	//IMAGES
	$nbTotal = mysql_numrows(mysql_query(" SELECT * FROM `possible` ORDER BY `possible`.`id` DESC"));
	$sql = mysql_query(" SELECT * FROM `possible` ORDER BY `possible`.`id` DESC LIMIT 0 , 104");
	$nbPos = mysql_numrows($sql);
	$lan = $GLOBALS['lan'];
	$ibox=0;
	while($result = mysql_fetch_array($sql)){
		$i++;
		$ibox++;
		$tagPossible = tagPossible($result['idDec'],$lan);
		$titre = antiHack($tagPossible["0v"].$tagPossible["1v"]);
		$resprov .= '<a href="'.$result['idDec'].'.'.$lan.'"><img title="'.$titre.'" src="'.mkId(decbin($result['idDec'])).'-9-0.png" ></a>';
	}
	$toEch1 = '
		<section class="col ">
			
			<aside ><h2>'.trans($lan,223).'</h2><p class="gird">'.$resprov.'</p></aside>
		</section>';

	/////////WORDS	
	$sql1 = mysql_query("SELECT * , COUNT( * ) AS somme FROM `possibleTag` WHERE `lan` LIKE '$lan' GROUP BY `tag` ORDER BY `tag` ASC");
	while($result = mysql_fetch_array($sql1)){
		
		$firstLetter = substr($result['tag'], 0, 1);
		
		if($firstLetter != $firstEx and preg_match("#[a-zA-Z]+#", $firstLetter)){
			
			$toEch2 .= '<aside><h2>'.$firstEx .'</h2><p class="list">';
			if(!isset($close)) $close = "</p></aside>";
			$toEch2 .= $resu.$close;
			$resu ="";
			$firstEx = $firstLetter;
		}
		$resu .= ' <a href="'.antiHack($result['tag']).'.txt">'.antiHack($result['tag']).'</a>';
		
	}
	$toEch2 = '
	<section class="col X2">
		<aside><h2>A-Z</h2>
		<p class="list">
		'.$toEch2.'
		</p>
		</aside>
	</section>
	';
	$toEch = '<section id="posId">
			<h1 class="txt">*</h1>
		</section>'.$toEch1.$toEch2;
	break;
case'rand':
	$title = trans($lan,213);
	for($isa=0;$isa<4;$isa++){
		$randStuff .='<div class="proches" >';
		for($isi=0;$isi<3;$isi++){
			$randStuff .='<h2></h2><p class="coloneS">';
			for($is=0;$is<16;$is++){// Formes Aléatoires
				$chiffre = rand(1,65536);
				$randStuff .= '<a href="'.$chiffre.'.'.$lan.'"><img src="'.mkId(decbin($chiffre)).'-8.png" ></a>';
			}
			$randStuff .='</p>';
		}
		$randStuff .='</div>';
	}
	$toEch = '
				<div id="posId">
				<h1 class="txt">?</h1>
				<div id="cont">
				'.$randStuff.'
				</div>
				</div>';
	break;
case'words':

	break;


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
<title><?php echo $title ?></title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
#cont {
	height:2000px;
}
</style>
<body id="template">
<? include('media/pages/langueSw.php'); ?>	
<div id="page">
<?php
if(isset($toInc))include('../pages/'.$toInc);
if(isset($toEch))echo $toEch;

?>
		<section class="col">
			<? include('media/pages/find.php'); ?>						
		</section>
</div>
<? include('media/pages/analytics.php'); ?>	
</body>
</html>
