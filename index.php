<?


include('machine/_fonctions.php');

$sql2 = mysql_query("SELECT * FROM `possibleTag` ORDER BY RAND() LIMIT 1");
$arr1 = mysql_fetch_array($sql2);
$idDec = $arr1['idDec'];

$fAutres .= '../'.mkId(decbin($idDec)).'-100.png';

$tagPossible = tagPossible($idDec,"fr");

$Langue = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$Langue = strtolower(substr(chop($Langue[0]),0,2));
	
if($Langue =="fr") $lan = "fr";
else $lan = "en";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="alternate" type="application/rss+xml" title="Flux" href="rss.xml" />
    
    <? // if(!isset($_GET['mode']))echo '<meta http-equiv="refresh" content="4";>'; ?>

    <title>Possible ? The all 4x4 images collection to describe ... <?= $tagPossible['0v'].$tagPossible['1v'] ?>
    </title>
</head>

<body id="index" >
    <div id="page">
    	<section id="posId">
    		<aside>
    			<h2><?='<a href="'.$idDec.'.fr">'?><img src="f337-5.png" /><img src="f151-5.png" />
				<img src="f9b3-5.png" /><img src="f9b3-5.png" />
				<img src="ffbb-5.png" /><img src="f311-5.png" />
				<img src="f771-5.png" /><img src="f731-5.png" /></a><br/> the 65 536 <strong>4x4</strong> pixels<br />images directory</h2></aside>
    	</section>
	<? echo '
		<div class="elem">
			<a href="'.$idDec.'.'.$lan.'"><img src="'.$fAutres.'"></a>
            <h2>this is '.$tagPossible[0].$tagPossible[1].'</h2>
		</div>
        ';
        ?>
        <?


?>
        <div>
    	</div>
	</div>
</body>
</html>
