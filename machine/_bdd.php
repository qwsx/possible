<?php
$bdd_serveur     = "localhost";
$bdd_utilisateur = "dcfvgfr_dcfvg";
$bdd_motDePasse  = "fx?!HbbiNKxJ";
$bdd_base        = "dcfvgfr_002-possible";
	date_default_timezone_set ("Europe/Paris");
	
	
$power = mysql_connect($bdd_serveur, $bdd_utilisateur, $bdd_motDePasse)
        or die("Impossible de se connecter au serveur de bases de données.");
    	mysql_select_db($bdd_base)
        or die("Impossible de se connecter à la base de données.");
        mysql_query('SET CHARACTER SET utf8');
?>