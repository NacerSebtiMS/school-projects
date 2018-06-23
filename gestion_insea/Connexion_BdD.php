<?php
$serveur='localhost';
$database='suivi_cours';
$user='root';
$pass='';

$db = mysqli_connect($serveur,$user,$pass,$database);
if(mysqli_connect_errno($db)){
	die("echec de la connexion lors de la connexion à mysqli : " . mysqli_connect_error());
}
?>
