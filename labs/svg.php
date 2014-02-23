<?php
include('../machine/_fonctions.php');
$arrayUrl = explode("-",$_GET['backVars']);
$img = trId($arrayUrl[0]);


$xtaille = $arrayUrl[1];
$color = $arrayUrl[2];






for ($B = 0; $B < 10000; $B++){ $svg .= idToSvg(decbin($B),2).'  ';}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">

<html>
<head>
    <title></title>
</head>

<body><? echo $svg?></body>
</html>
