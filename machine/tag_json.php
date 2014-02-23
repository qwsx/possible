<?php
	
	include('_bdd.php');
	$param = ereg_replace("[^A-Za-z0-9]", "", $_GET["term"] );
	
	switch ($_GET["lan"]) {
	 case 'fr': $lan = "fr" break;
   case 'fr': $lan = "en" break;
	 default: exit();break;
	}

	$query = mysql_query("SELECT * FROM 'tag$lan' WHERE tag REGEXP '^$param'  GROUP BY tag ORDER BY nb DESC LIMIT 0 , 6");
	for ($x = 0, $numrows = mysql_num_rows($query); $x < $numrows; $x++) {
		$row = mysql_fetch_assoc($query);
    
		$tags[$x] = array("name" => $row["tag"]);		
	}
	mysql_close($power);

	echo $response = $_GET["callback"] . "(" . json_encode($tags) . ")";
?>