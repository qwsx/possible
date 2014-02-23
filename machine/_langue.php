<?php
if(isset($_COOKIE['lan']))	$lan = $_COOKIE['lan'];
if(isset($_GET['lan']))		$lan = $_GET['lan'];

$GLOBALS['lan'] = $lan;
setcookie('lan',$lan, (time() + 36000000 )); 

// FRANCAIS
$lanGb =  "fr";
$GLOBALS[$lanGb][000];
$GLOBALS[$lanGb][100] = "Chercher une forme ?";
$GLOBALS[$lanGb][101] = "Je vois quelque chose !";
$GLOBALS[$lanGb][102] = "Je parle Francais";
$GLOBALS[$lanGb][110] = "A propos des possibles";
$GLOBALS[$lanGb][111] = "image possible";
// id page 200
$GLOBALS[$lanGb][211] = "Très proches";
$GLOBALS[$lanGb][212] = "Proches";
$GLOBALS[$lanGb][213] = "Autres formes";
$GLOBALS[$lanGb][214] = "Français";
$GLOBALS[$lanGb][215] = "Décrire la forme";
$GLOBALS[$lanGb][216] = "Mot clefs ( Fran&ccedil;ais )";
$GLOBALS[$lanGb][217] = "par";
$GLOBALS[$lanGb][218] = "Recherche";
$GLOBALS[$lanGb][219] = "Top mots";
$GLOBALS[$lanGb][220] = "Mot en image";
$GLOBALS[$lanGb][221] = "Rechercher :";
$GLOBALS[$lanGb][222] = "A-Z - tout les mots.";
$GLOBALS[$lanGb][223] = "Découvertes récentes";
$GLOBALS[$lanGb][224] = "Aide ?";
$GLOBALS[$lanGb][225] = "Bientôt";
$GLOBALS[$lanGb][226] = "Voir aussi";
$GLOBALS[$lanGb][227] = "Ailleurs ?";
$GLOBALS[$lanGb][228] = "Ajouter";
$GLOBALS[$lanGb][229] = "Tout les mots";
$GLOBALS[$lanGb][230] = "Par lettres de A - Z";
$GLOBALS[$lanGb][231] = ""; //Discovered by
$GLOBALS[$lanGb][232] = "MAJ";
$GLOBALS[$lanGb][233] = "Saisissez les deux mots";
$GLOBALS[$lanGb][234] = "nom";

// ENGLISH 
$lanGb =  "en";
// id page 200
$GLOBALS[$lanGb][000];
$GLOBALS[$lanGb][100] = "Find a shape ?";
$GLOBALS[$lanGb][101] = "i can see somthing !";
$GLOBALS[$lanGb][102] = "I speak English";
$GLOBALS[$lanGb][110] = "About the possibles";
$GLOBALS[$lanGb][111] = "possible image";
$GLOBALS[$lanGb][211] = "Same kind of paterns";
$GLOBALS[$lanGb][212] = "Similar paterns";
$GLOBALS[$lanGb][213] = "Other paterns";
$GLOBALS[$lanGb][214] = "In English";
$GLOBALS[$lanGb][215] = "Add Words";
$GLOBALS[$lanGb][216] = "Add tags (English)";
$GLOBALS[$lanGb][217] = "by";
$GLOBALS[$lanGb][218] = "Find Shape";
$GLOBALS[$lanGb][219] = "Top words";
$GLOBALS[$lanGb][220] = "Word to shape";
$GLOBALS[$lanGb][221] = "Search :";
$GLOBALS[$lanGb][222] = "A-Z - All words.";
$GLOBALS[$lanGb][223] = "Latest discovered shapes";
$GLOBALS[$lanGb][224] = "help ?";
$GLOBALS[$lanGb][225] = "Soon";
$GLOBALS[$lanGb][226] = "See also";
$GLOBALS[$lanGb][227] = "Other languages.";
$GLOBALS[$lanGb][228] = "Add";
$GLOBALS[$lanGb][229] = "All the words";
$GLOBALS[$lanGb][230] = "From  A-to-Z";
$GLOBALS[$lanGb][231] = ""; // Discovered by
$GLOBALS[$lanGb][232] = "updated";
$GLOBALS[$lanGb][233] = "Type the two words :";
$GLOBALS[$lanGb][234] = "name";

?>