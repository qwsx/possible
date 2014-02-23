<?php  //$jourdui= date("D, d M Y H:i:s +0100");
include('../_fonctions.php');
$jourdui= date("D, d M Y H:i:s");
$head .= '<?xml version="1.0" encoding="ISO-8859-1" ?>';
$head .= '
<rss version="2.0">
<channel>
	<title>Possible</title>
	<link>http://possible.dcfvg.com</link>
	<description>Possibles</description>
	<language>fr</language>
	<image>
		<title>Possible</title>
		<url>http://possible.dcfvg.com/1517-10.png</url>
		<link>http://possible.dcfvg.com</link>
	</image>
	<lastBuildDate>'.$jourdui.' +0100</lastBuildDate>
	<copyright>Versatile.fr - 2000- '.date("Y").'</copyright> ';
$requete = mysql_query("SELECT * FROM `possibleTag` GROUP BY `idDec` ORDER BY `id` DESC LIMIT 0 , 40");
while ($ligne = mysql_fetch_array($requete)){
	$sql2 = mysql_query("SELECT *,UNIX_TIMESTAMP(crea) as creaU ,UNIX_TIMESTAMP(upd) as updU FROM `possible` WHERE `idDec` =".$ligne['idDec']);
	$result2 = mysql_fetch_array($sql2);
	$date = date("D, d M Y H:i:s",$result2['updU']);
	$lan = $ligne['lan'];
	$idDec = $ligne['idDec'];
	$tagPossible = tagPossible($idDec,$lan);
	if($result2['updBy'] != "") $by = '<br />by <a href="http://'.$result2['updBySite'].'" target="_blank" ">'.$result2['updBy'].'</a>';
	$item .= '
	<item>
		<title>'.ucfirst($ligne['tag']).' ['.$lan.'] ?</title>
		<guid>http://possible.dcfvg.com/'.$idDec.'.'.$lan.'</guid>
		<pubDate>'.$date.' +0100</pubDate>
		<description>
			<![CDATA[<p><a href="http://possible.dcfvg.com/'.$idDec.'.'.$lan.'" ">#'.$idDec.'<br /><img src="http://possible.dcfvg.com/'.mkId(decbin($idDec)).'-30.png" />
			<br /><br /> <img src="http://possible.dcfvg.com/'.mkId(decbin($idDec)).'-2.png" /></a> '.$tagPossible[0].''.$by.'
			</p>]]>
		</description>
	</item>';
}
$foot .= "
</channel>
</rss>";
echo $head.$item.$foot
?>
