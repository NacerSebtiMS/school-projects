<?php
   include("Connexion_BdD.php");
   session_start();
   session_unset();
   header("Location: login.php");
?>
