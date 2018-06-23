<!doctype>

<html>
<head>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" href="css/normalize.css">
			<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/main.css">
	<title>Admin : Ajout sceance</title>
</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
	function listeProf(){
		include("Connexion_BdD.php");
		$roquette = "SELECT id_prof, nom_prof, prenom_prof FROM professeur";
		$liste = mysqli_query($db, $roquette);
		return $liste;
	}

	function checkJF($jour){
		include("Connexion_BdD.php");
		$roquette = "SELECT jour FROM jours_ferier WHERE jour ='".$jour."'";
		$res = mysqli_query($db, $roquette);
		if($res->num_rows == 0) return 1;
		else return 0;
	}

	include("Connexion_BdD.php");



	$ok = 0;
	if ( isset($_POST["annee_scolaire"]) && $_POST["annee_scolaire"] != ""
		&& isset($_POST["semestre"]) && $_POST["semestre"] != ""
		&& isset($_POST["periode"]) && $_POST["periode"] != ""
		&& isset($_POST["filiere"]) && $_POST["filiere"] != ""
		&& isset($_POST["niveau"]) && $_POST["niveau"] != ""
		&& isset($_POST["groupe"]) && $_POST["groupe"] != ""
	) {
		$ok = 1;
		if ( isset($_POST["jour"]) && $_POST["jour"] != ""
			&& isset($_POST["heure_deb"]) && $_POST["heure_deb"] != ""
			&& isset($_POST["element"]) && $_POST["element"] != ""
			&& isset($_POST["salle"]) && $_POST["salle"] != ""
			&& isset($_POST["professeur"]) && $_POST["professeur"] != ""
			) {
			//if (checkJF($_POST['jour']) == 1) {
				$heure_fin = $_POST["heure_deb"]+2;
				for ($i=0; $i < $_POST['nbr_sceances']; $i++) {
					$req = "INSERT INTO emploi_temps (annee_scolaire,filiere,semestre,niveau,periode,jour,heure_deb,heure_fin,element,salle,professeur,groupe,etat_seance) VALUES (
						".$_POST["annee_scolaire"].",
						'".$_POST["filiere"]."',
						'".$_POST["semestre"]."',
						'".$_POST["niveau"]."',
						'".$_POST["periode"]."',
						DATE_ADD('".$_POST["jour"]."', INTERVAL ".strval(7*$i)." DAY),
						".$_POST["heure_deb"].",
						".$heure_fin.",
						'".$_POST["element"]."',
						'".$_POST["salle"]."',
						'".$_POST["professeur"]."',
						'".$_POST["groupe"]."',
						'prevu')";

					$ajout = mysqli_query($db, $req);
				}

				if ($ajout) {
					echo "Ajout avec succes";
				} else {
					echo "Erreur";
				}
			//} else echo "Le jour selectionne est ferie";
		}
	}

?>
	<body>
		<a href="logout.php"><button value="Valider">Se deconnecter</button></a>
		<div class="topnav">
			<a href="ajout_prof.php">ajouter un professeur</a>
  		<a href="ajout_sceance.php"> ajouter une seance</a>
  		<a href="lister_profs.php">lister les professeurs</a>
  		<a href="emp_admin.php">Emploi de temps</a>
  		<a href="tableau_bord.php">Tableu de bord</a>
			<a href="check_emploi.php">Verifier les cours</a>
	 </div>
		<form action='ajout_sceance.php' method='POST'>
			<h2>Informations Classe</h2>
			Annee Scolaire : <input type="number" name="annee_scolaire" <?php if ($ok) {echo " value='".$_POST["annee_scolaire"]."'";} ?>><br>

			Semestre :
			<select name="semestre">
				<option value="s1" <?php if ($ok) if ($_POST["semestre"]=="s1") echo " selected"; ?>>S1</option>
				<option value="s2" <?php if ($ok) if ($_POST["semestre"]=="s2") echo " selected"; ?>>S2</option>
				<option value="s3" <?php if ($ok) if ($_POST["semestre"]=="s3") echo " selected"; ?>>S3</option>
				<option value="s4" <?php if ($ok) if ($_POST["semestre"]=="s4") echo " selected"; ?>>S4</option>
				<option value="s5" <?php if ($ok) if ($_POST["semestre"]=="s5") echo " selected"; ?>>S5</option>
			</select><br>

			Periode :
			<select name="periode">
				<option value="t1" <?php if ($ok) if ($_POST["periode"]=="t1") echo " selected"; ?>>Trimestre 1</option>
				<option value="t2" <?php if ($ok) if ($_POST["periode"]=="t2") echo " selected"; ?>>Trimestre 2</option>
			</select><br>

			Filiere :
			<select name="filiere">
				<option value="info" <?php if ($ok) if ($_POST["filiere"]=="info") echo " selected"; ?>>Info</option>
				<option value="af" <?php if ($ok) if ($_POST["filiere"]=="af") echo " selected"; ?>>A-F</option>
				<option value="se" <?php if ($ok) if ($_POST["filiere"]=="se") echo " selected"; ?>>S-E</option>
				<option value="sd" <?php if ($ok) if ($_POST["filiere"]=="sd") echo " selected"; ?>>S-D</option>
				<option value="road" <?php if ($ok) if ($_POST["filiere"]=="road") echo " selected"; ?>>ROAD</option>
			</select><br>

			Niveau :
			<select name="niveau">
				<option value="a1" <?php if ($ok) if ($_POST["niveau"]=="a1") echo " selected"; ?>>Premiere annee</option>
				<option value="a2" <?php if ($ok) if ($_POST["niveau"]=="a2") echo " selected"; ?>>Deuxieme annee</option>
				<option value="a3" <?php if ($ok) if ($_POST["niveau"]=="a3") echo " selected"; ?>>Troisieme annee</option>
			</select><br>

			Groupe :
			<select name="groupe">
				<option value="g1" <?php if ($ok) if ($_POST["groupe"]=="g1") echo " selected"; ?>>Groupe 1</option>
				<option value="g2" <?php if ($ok) if ($_POST["groupe"]=="g2") echo " selected"; ?>>Groupe 2</option>
				<option value="g3" <?php if ($ok) if ($_POST["groupe"]=="g3") echo " selected"; ?>>Groupe 3</option>
				<option value="g4" <?php if ($ok) if ($_POST["groupe"]=="g4") echo " selected"; ?>>Groupe 4</option>
				<option value="g5" <?php if ($ok) if ($_POST["groupe"]=="g5") echo " selected"; ?>>Groupe 5</option>
				<option value="g6" <?php if ($ok) if ($_POST["groupe"]=="g6") echo " selected"; ?>>Groupe 6</option>
				<option value="g7" <?php if ($ok) if ($_POST["groupe"]=="g7") echo " selected"; ?>>Groupe 7</option>
				<option value="g8" <?php if ($ok) if ($_POST["groupe"]=="g8") echo " selected"; ?>>Groupe 8</option>
			</select><br><br>


			<h2>Informations sceance</h2>
			Date debut element :<input type="date" name="jour" /><br>
			Nombre de sceances :<input type="number" name="nbr_sceances"><br>
			Heure sceance :
			<select name="heure_deb">
				<option value="8">8h - 10h</option>
				<option value="10">10h - 12h</option>
				<option value="14">14h - 16h</option>
				<option value="16">16h - 18h</option>
			</select><br>
			element:<input type="text" name="element" /><br>
			Salle:  <input type="text" name="salle" /><br> <br>

			Professeur:
			<select name="professeur">
				<?php
				$profs = listeProf();
				foreach ($profs as $data) {
					echo '<option value="'.$data["id_prof"].'">'.$data["nom_prof"].' '.$data["prenom_prof"].'</option>';
				}
				?>
			</select><br>

			<input type="submit" name="" value="Valider">

		</form>

	</body>
</html>
<?php } else header("Location: login.php") ?>

<style type="text/css">
.topnav {
    background-color: #333;
    overflow: hidden;
}

.topnav a {
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}

.topnav a:hover {
    background-color: #ddd;
    color: black;
}


.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
	table{
		width: 55%;
	}
	img{
		width: 50px;
	}
	.imgbox{
		width: 50px;
	}
	td{
		text-align: center;
	}
</style>
