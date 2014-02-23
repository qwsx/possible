<?php
//error_reporting(E_ALL ^ E_NOTICE);
//set_time_limit(0);
include('bdd.php');
include('langue.php');

// OPERATIONS SUR LES IDDEC 
		function mkId($pos){ // dec >>>  hex 
			return dechex(bindec($pos));
		}
		
		//....................................................................
		function trId($id){// hex >>>  dec
			return str_pad(decbin(hexdec($id)), 16, "0", STR_PAD_LEFT);
		}
		
		//....................................................................
		function f16($chiffre) {
			return str_pad($chiffre, 16, "0", STR_PAD_LEFT);
		}
		
		//....................................................................
		function trans($lan,$id){ // traduction
			if(isset($GLOBALS[$lan][$id])){
				return $GLOBALS[$lan][$id];
			}else{
				return $GLOBALS['fr'][$id];
			}
		};

// IMAGES 
		//....................................................................
		
		function idToSvg($idBin,$taille){
			$tComb = 4;	
			for ($j = 0; $j < 16; $j++) {
				$coX = ($j%$tComb)*$taille;
				$coY = floor($j/$tComb)*$taille;
				if(substr($idBin,$j,1) == 0) $svg .= '<rect x="'.$coX.'" y="'.$coY.'" width="'.$taille.'" height="'.$taille.'" style="fill:#0"/>';
			}
			return '<svg xmlns="http://www.w3.org/2000/svg" width="'.($tComb*$taille).'" height="'.($tComb*$taille).'" viewBox="0 0 '.($tComb*$taille).' '.($tComb*$taille).'">'.$svg."</svg>";
		}

// TRANSFORMATION D'UNE SOLUTION
		//....................................................................
		function rot180($list){
			return strrev($list[1].$list[2].$list[3].$list[4]) ;
		}
		
		//....................................................................
		function rotM90($list){
			return strrev($list[5]).strrev($list[6]).strrev($list[7]).strrev($list[8]);
		}
		
		//....................................................................
		function rotP90($list) {
			return $list[8].$list[7].$list[6].$list[5];
		}
		
		//....................................................................
		function symVer($list){
			return strrev($list[1]).strrev($list[2]).strrev($list[3]).strrev($list[4]);
		}
		//....................................................................
		function symHor($list){
			return strrev(strrev($list[1]).strrev($list[2]).strrev($list[3]).strrev($list[4]));
		}
		//....................................................................
		function symHorRotM90($list){
			return strrev($list[8]).strrev($list[7]).strrev($list[6]).strrev($list[5]);
		}
		//....................................................................
		function symHorRotP90($list){
			return $list[5].$list[6].$list[7].$list[8];
		}
		//....................................................................
		function neg($b){
			return str_replace("a","1",str_replace("1","0",str_replace("0","a",f16($b))));
		}
		//....................................................................
		function lineList($c){
			$c = f16($c);
			$list[0] = $c;
			for($i=0;$i<4;$i++){
				$list[$i+1] = substr($c,$i*4,4);
				$list[$i+5] = substr($c,$i,1).substr($c,4+$i,1).substr($c,8+$i,1).substr($c,12+$i,1);
			}
			return $list;
		}
	//....................................................................
	function cas($d,$negs,$supPr) { // cas proches
		$put=0;
		$list = lineList($d);
		$c = bindec($d);
		$result = array();
		$preResult[0] = rot180($list);
		$preResult[1] = symVer($list);
		$preResult[2] = symHor($list);
		$preResult[3] = rotP90($list);
		$preResult[4] = rotM90($list);
		$preResult[5] = symHorRotM90($list);
		$preResult[6] = symHorRotP90($list);
		if($negs){
			$preResult[7] = neg($d);
			$preResult[8] = neg($preResult[0]);
			$preResult[9] = neg($preResult[1]);
			$preResult[10] = neg($preResult[2]);
			$preResult[11] = neg($preResult[3]);
			$preResult[12] = neg($preResult[4]);
			$preResult[13] = neg($preResult[5]);
			$preResult[14] = neg($preResult[6]);
		}
		foreach ($preResult as $bin) {
			if($supPr){
				if(bindec($bin)<$c){
					if (!in_array($bin, $result) ) {
						$result[ ] = $bin;
					}
				}
			}else{
				if (!in_array($bin, $result) and bindec($bin) != $c) {
						$result[ ] = $bin;
				}
			}
		}	
		return $result;
	}//....................................................................
	function weblogUpdates_ping($blog_title, $blog_url, $rpc_host, $rpc_page='/', $rpc_port='80')
		{
		$xml_rpc = '<?xml version="1.0" encoding="utf-8"?>'."\r\n";
		$xml_rpc .= '<methodCall>'."\r\n";
		$xml_rpc .= '	<methodName>weblogUpdates.ping</methodName>'."\r\n";
		$xml_rpc .= '	<params>'."\r\n";
		$xml_rpc .= '		<param>'."\r\n";
		$xml_rpc .= '			<value>'.$blog_title.'</value>'."\r\n";
		$xml_rpc .= '		</param>'."\r\n";
		$xml_rpc .= '		<param>'."\r\n";
		$xml_rpc .= '			<value>'.$blog_url.'</value>'."\r\n";
		$xml_rpc .= '		</param>'."\r\n";
		$xml_rpc .= '	</params>'."\r\n";
		$xml_rpc .= '</methodCall>'."\r\n";
	
		$xml_rpc_length = strlen($xml_rpc);
	
		$http_request = 'POST '.$rpc_page.' HTTP/1.0'."\r\n";
		$http_request .= 'User-Agent: wall.versatile.fr'."\r\n";
		$http_request .= 'Host: '.$rpc_host."\r\n";
		$http_request .= 'Content-Type: text/xml'."\r\n";
		$http_request .= 'Content-length: '.$xml_rpc_length."\r\n\r\n";
		$http_request .= $xml_rpc."\r\n";
		
		/* Décommentez la ligne suivante pour afficher la requête XML-RPC */
		//echo '<p>Requête XML-RPC :</p><pre>'.htmlentities($http_request).'</pre>';
	
		$theSock = @fsockopen($rpc_host, $rpc_port);
		if($theSock)
		{
			@fwrite($theSock,$http_request);
			@stream_set_blocking($theSock,1);
	
			while(!@feof($theSock))
			{
				$buf .= @fgets($theSock,128);
			}
			@fclose($theSock);
			//echo '<p>Réponse XML-RPC :</p>'."\r\n\r\n".'<pre>'.htmlentities($buf).'</pre>';
		}
}//....................................................................

// SORTIES DEPUIS LA BASE
//....................................................................
	function linkTag($tag,$lan,$class,$nb){
		return '<a href="'.$tag.'.txt" title ="'.$nb.' votes."> '.$tag.'<sup>|'.$lan.'|</sup></a>';
	}
	//....................................................................
	function tagPossible($idDec,$lan){ 
		$sql1 = mysql_query("SELECT * FROM `possibleTag` WHERE `idDec` = $idDec ORDER BY `nb` DESC, `tag` DESC");
		//$nbTag = mysql_numrows($sql1);
		$ret['fr'] = array();
		$ret['en'] = array();
		$ret['es'] = array();
		$ret['de'] = array();
		while($result = mysql_fetch_array($sql1)){
				$groupe = 1;
				if($result['lan'] == $lan)$groupe = 0;
				$ret[$groupe] .= linkTag($result['tag'],$result['lan'],$class,$result['nb']);
				$ret[$result['lan']][] = $result['tag'];
				$ret[$groupe."v"] .= ucwords($result['tag']).' ['.$result['lan'].']  ';
				$ret[$groupe."seul"] .= ucwords($result['tag']).' ';
		}
		return $ret;
	}
	//....................................................................
	function possibleTag($tag){
		$sql1 = mysql_query("SELECT * FROM `possibleTag` WHERE `tag` LIKE '$tag' ORDER BY `nb` DESC");
		$langues = array();
		$idSrc = array();
		$doubles = array();
		$languesApp = array('fr','en','es','de');
		while($result = mysql_fetch_array($sql1)){
				if(!in_array($result['idDec'],$idSrc)){
					$idSrc[] = $result['idDec'];
					$ret['img'] .= '<a href="'.$result['idDec'].'.'.$GLOBALS['lan'].'"><img src="'.mkId(decbin($result['idDec'])).'-8.png" alt="'.$result['tag'].'" title="'.$result['tag'].'"/></a>';
				}
				if(!in_array($result['lan'],$langues)){
					$langues[] = $result['lan'];
					$ret['lan'] .= '['.$result['lan'].'] ';
				}
				
				$result = cas(decbin($result['idDec']),1,0);
				foreach ($result as $bin) {
					$tagPossible = tagPossible(bindec($bin),$GLOBALS['lan']);
					foreach ($languesApp as $lanA) {
						foreach ($tagPossible[$lanA] as $Rfr) {
							if(!in_array($Rfr,$doubles)){
								$doubles[] = $Rfr;
								$ret[$lanA] .= linkTag($Rfr,$lanA,$class,false);
							}
						}
					}
				}
		}
		return $ret;
	}//....................................................................
	function  dernierAjouts(){
		$sql = mysql_query(" SELECT *FROM `possibleTag` ORDER BY `possibleTag`.`id` DESC  LIMIT 0 , 16 ");
		$lan = $GLOBALS['lan'];
		while($result = mysql_fetch_array($sql)){
			$tag .= linkTag($result['tag'],$result['lan'],$class,$result['nb'])."<br />";
			$img .= '<a href="'.$result['idDec'].'.'.$lan.'"><img src="'.mkId(decbin($result['idDec'])).'-8.png" ></a>';
		}
		$res['tag'] = $tag;
		$res['img'] = $img;
		return $res;
	}
	//....................................................................
	function  dernierDecouverte(){
		$sql = mysql_query(" SELECT * FROM `possible` ORDER BY `possible`.`id` DESC LIMIT 0 , 16 ");
		$lan = $GLOBALS['lan'];
		while($result = mysql_fetch_array($sql)){
			$tagPossible = tagPossible($result['idDec'],$lan);
			$titre = antiHack($tagPossible["0v"].$tagPossible["1v"]);
			$res .= '<a href="'.$result['idDec'].'.'.$lan.'"><img title="'.$titre.'" src="'.mkId(decbin($result['idDec'])).'-8.png" ></a>';
		}
		return $res;
	}
	//....................................................................
	function meilleursMots(){
		$sql = mysql_query(" SELECT * FROM `posMostTag` ORDER BY `posMostTag`.`nbf` DESC LIMIT 0 , 30");
		while($result = mysql_fetch_array($sql)){
			$res .= linkTag($result['tag'],$result['lan'],$class,$result['nbf']);
		}
		return $res;
	}//....................................................................
	function motAutours($tag){
		$tagsAut[] = $tag;
		if(strlen($tag)<3){
			$tagReq = $tag;
		}else{
			$tagReq = "%$tag%";
		}
			
		$sql = mysql_query(" SELECT * FROM `possibleTag` WHERE `tag` LIKE '$tagReq' ORDER BY `possibleTag`.`nb` DESC LIMIT 0 , 50 ");
		while($result = mysql_fetch_array($sql)){
			$sql2 = mysql_query(" SELECT * FROM `possibleTag` WHERE `idDec` =".$result['idDec']." ORDER BY `possibleTag`.`tag` DESC LIMIT 0 , 50 ");
			while($result2 = mysql_fetch_array($sql2)){
				if(!in_array($result2['tag'],$tagsAut)){
					$tagsAut[] = $result2['tag'];
					$rendu[$result2['lan']] .= linkTag($result2['tag'],$result2['lan'],$class,$result2['nb']);
				}
			}
		}
		return $rendu;
	}//....................................................................
	function lettreImage($lettre){
		//$sql = mysql_query(" SELECT * FROM `possibleTag` WHERE `tag` LIKE '$lettre' ORDER BY `possibleTag`.`nb` DESC LIMIT 0 , 1 ");
	}//....................................................................

	
	// ECRITURE DANS LA BASE
	//....................................................................
	function  updateTag ($idDec,$tags,$lan){
		$arrayTag = explode(",",$tags);
		foreach ($arrayTag as $tag) {
			if($tag != ""){
				mysql_query("UPDATE `possibleTag` SET nb=nb+1 WHERE idDec=$idDec AND `tag` LIKE '$tag' AND `lan` LIKE '$lan'");
				if(!mysql_affected_rows()) {
					weblogUpdates_Ping('Possible', 'http://possible.versatile.fr', 'blogsearch.google.com', '/ping/RPC2');
					mysql_query("INSERT INTO `possibleTag` ( `id` , `idDec` , `nb` , `lan` ,`tag` ) VALUES ( NULL , '$idDec', '1', '$lan', '".strtolower($tag)."' );");
				}
			}
		}
	}
	//....................................................................
	function  updatePos($idDec,$lan,$by,$bySite) {
		mysql_query("UPDATE `possible` SET visite=visite+1, updBy = '$by', updBySite = '$bySite' WHERE idDec= $idDec");
		if(!mysql_affected_rows()) mysql_query("INSERT INTO  `possible` (`id` ,`idDec` ,`crea` ,`creaBy` ,`creaBySite` ,`upd` ,`updBy` ,`updBySite` ,`visite`) 
																			   VALUES (NULL ,  '$idDec', NOW( ), '$by','$bySite', NOW( ) ,  '$by',  '$bySite',  '1');");
	}//....................................................................
	function pixSiteMap ($langue) {
		$requete = mysql_query("SELECT *,UNIX_TIMESTAMP(crea) as creaU ,UNIX_TIMESTAMP(upd) as updU FROM `possible` ORDER BY `idDec`");
				while ($ligne = mysql_fetch_array($requete)){
				$mod = date("Y-m-d",$ligne['updU']);
				$prio = 0.7;
				$sitePortail = "http://possible.versatile.fr";				
				$siteMap .= '
				<url>
					<loc>'.$sitePortail.'/'.$ligne['idDec'].'.'.$langue.'</loc>
					<lastmod>'.$mod.'</lastmod>
					<priority>'.$prio.'</priority>
				</url>';
				}
			$sql1 = mysql_query("SELECT * , COUNT( * ) AS somme FROM `possibleTag` GROUP BY `tag` ORDER BY `idDec` DESC");
			while($result = mysql_fetch_array($sql1)){
					$sql2 = mysql_query("SELECT *,UNIX_TIMESTAMP(crea) as creaU ,UNIX_TIMESTAMP(upd) as updU FROM `possible` WHERE `idDec` =".$result['idDec']);
					$result2 = mysql_fetch_array($sql2);
					$mod =  date("Y-m-d",$result2['updU']);
					$siteMap .= '
				<url>
					<loc>'.$sitePortail.'/'.$result['tag'].'.txt</loc>
					<lastmod>'.$mod.'</lastmod>
					<priority>0.8</priority>
				</url>';

			}

				return $siteMap;
	}//....................................................................
	function GenSiteMap($langue) {
			$sitePortail = "http://possible.versatile.fr";
			$mod = date("Y-m-d");
		$siteMap = '<?xml version=\'1.0\' encoding=\'UTF-8\'?>
		<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84
		http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';
		$siteMap.= pixSiteMap(strtolower($langue));		
		$siteMap.='
			<url>
				<loc>http://possible.versatile.fr/</loc>
				<lastmod>'.$mod.'</lastmod>
				<priority>0.9</priority>
			</url>
			<url>
				<loc>http://possible.versatile.fr/words.fr</loc>
				<lastmod>'.$mod.'</lastmod>
				<priority>0.9</priority>
			</url>
			<url>
				<loc>http://possible.versatile.fr/seeAlso.fr</loc>
				<lastmod>'.$mod.'</lastmod>
				<priority>0.9</priority>
			</url>
			<url>
				<loc>http://possible.versatile.fr/*.fr</loc>
				<lastmod>'.$mod.'</lastmod>
				<priority>0.9</priority>
			</url>
			<url>
				<loc>http://possible.versatile.fr/rand.fr</loc>
				<lastmod>'.$mod.'</lastmod>
				<priority>0.9</priority>
			</url>
		</urlset>';
		$fp = fopen("../sitemap.xml", 'w+');
		fputs($fp, $siteMap);
		fclose($fp);
		return $siteMap; 
	}//....................................................................


// STAND BY
//....................................................................
	function tagSimilaires($idDec,$tag){ /// STAND BY - CRON JOB
		$sql1 = mysql_query("SELECT * , COUNT( * ) AS somme FROM `possibleTag` WHERE `idDec` = $idDec GROUP BY `tag` ORDER BY somme DESC");	
		$tagArray [] = $tag;
		while($result = mysql_fetch_array($sql1)){
			if(!in_array($result['tag'],$tagArray)){
				$tagArray [] = $result['tag'].$result['lan'];
			}
		}
		return $ret;
	}
	
// OPERATIONS RECHERCHER REMPLACER
//....................................................................
	function antiHack($txt){
		$txt = htmlspecialchars($txt);
		$txt = strip_tags($txt);
		$txt = stripslashes($txt);
		$txt = nl2br($txt);
		
		$txt= str_replace("&amp;#","&#'",$txt);
		
		$detect = array('"', "'");
		$txt= str_replace($detect,' ',$txt);
		
		//$detect = ;
		//$txt= str_replace("'","\'",$txt);
		//$txt = liens($txt);
		//$txt = ucfirst($txt);
		return $txt;
	}//....................................................................
function cleanTitre($txt){
		$txt = strip_tags($txt);
		if(substr($txt,0,1) == " ")$txt = substr($txt,1); 
		$txt= str_replace("|fr|",",",$txt);
		$txt= str_replace("|en|",",",$txt);
		$txt= str_replace("|de|",",",$txt);
		$txt= str_replace("|es|",",",$txt);
		$txt= ucwords($txt);
		//$detect = array('"', "'");
		//$txt= str_replace($detect,'\"',$txt);
			//$detect = ;
		//$txt= str_replace("'","\'",$txt);
		//$txt = liens($txt);
		//$txt = ucfirst($txt);
		return $txt;
	}//....................................................................
	
	function htmlFinder($texte){
		//preg_match("#(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))#", "$texte");
		
		$avant = strlen($texte);
		$apres = strlen(strip_tags($texte));
		if($avant - $apres < 0){
			return true;
		}else{
			return false;
		}
	}
?>
