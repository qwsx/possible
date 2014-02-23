<?php
	
	include('../../machine/_bdd.php');
	
	$param = $_GET["term"];
	
	//query the database
	$query = mysql_query("SELECT * FROM tagfr WHERE tag REGEXP '^$param'  GROUP BY tag ORDER BY nb DESC LIMIT 0 , 10");
	
	//build array of results
	for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
		$row = mysql_fetch_assoc($query);
    
		$friends[$x] = array("name" => $row["tag"]);		
	}
	
	//echo JSON to page
	$response = $_GET["callback"] . "(" . json_encode($friends) . ")";
	echo $response;
	
	mysql_close($server);
	
?>