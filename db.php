<?php
//$host="sql309.epizy.com";$userName="epiz_31586640";$password="7x2YhhXFESAXPdn";$db="epiz_31586640_gameTroupe";
$host="localhost";$userName="root";$password="";$db="scoring";
$Scoring=new mysqli($host,$userName,$password,$db);
if($Scoring->connect_error)
    die("Connection failed: ".$Scoring->connect_error);
//connecting database
?>