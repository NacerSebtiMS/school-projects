<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
		include("Connexion_BdD.php");
		if (isset($_GET['id']) && $_GET['id'] != "") {
			$req = "UPDATE emploi_temps SET etat_seance = 'reporte' WHERE emploi_temps.id_emploi_temps =".$_GET['id'];
			$exec = mysqli_query($db, $req);
			$complete = "?annee_scolaire=".$_GET["annee_scolaire"]
							."&semestre=".$_GET["semestre"]
							."&jour=".$_GET["jour"]
							."&periode=".$_GET["periode"]
							."&filiere=".$_GET["filiere"]
							."&niveau=".$_GET["niveau"]
							."&groupe=".$_GET["groupe"];
			if($exec) header("Location: check_emploi.php".$complete);
			else echo "Erreur.<br><br><a href='emp_admin.php".$complete."'>Retour</a>";
		}
	} else header("Location: login.php")
?>
