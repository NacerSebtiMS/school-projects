<!doctype>

<html>
<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
		<title>Admin : Emploi du temps</title>
	</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
	include("Connexion_BdD.php");
	$ok=0;
	function afficheCours($c){
		echo $c["element"]."<br>";
		echo $c["salle"]."<br>";
		echo $c["professeur"]."<br>";
		/*$complete = "?id=".$c['id']
						."&annee_scolaire=".$_GET["annee_scolaire"]
						."&semestre=".$_GET["semestre"]
						."&periode=".$_GET["periode"]
						."&filiere=".$_GET["filiere"]
						."&niveau=".$_GET["niveau"]
						."&groupe=".$_GET["groupe"];
		echo "<a href='conf_cours.php".$complete."'>C</a>"
				." "."<a href='supp_cours.php".$complete."'>S</a>"
				." "."<a href='report_cours.php".$complete."'>R</a>";*/
	}
	if ( isset($_GET["annee_scolaire"]) && $_GET["annee_scolaire"] != ""
		&& isset($_GET["semestre"]) && $_GET["semestre"] != ""
		&& isset($_GET["periode"]) && $_GET["periode"] != ""
		&& isset($_GET["filiere"]) && $_GET["filiere"] != ""
		&& isset($_GET["niveau"]) && $_GET["niveau"] != ""
		&& isset($_GET["groupe"]) && $_GET["groupe"] != ""
	) {
		$ok=1;
		$req = "SELECT et.id_emploi_temps id,et.annee_scolaire, et.semestre, et.niveau, et.periode, WEEKDAY(et.jour) j, et.heure_deb, et.heure_fin, et.element, et.salle, p.nom_prof professeur, et.groupe, et.etat_seance es, et.filiere
				FROM emploi_temps et, professeur p
				WHERE et.professeur = p.id_prof
						AND annee_scolaire = ".	$_GET["annee_scolaire"]."
						AND semestre = '".	$_GET["semestre"]."'
						AND periode = '".	$_GET["periode"]."'
						AND filiere = '".	$_GET["filiere"]."'
						AND niveau = '".	$_GET["niveau"]."'
						AND groupe = '".	$_GET["groupe"]."'
				ORDER BY heure_deb";
		$emploi = mysqli_query($db, $req);
		if($emploi){
			foreach ($emploi as $data) {
				$cours[ $data["j"] ][ $data["heure_deb"] ] = $data;
			}
		}
	}
	$jour = -1;
?>
	<body>

		<a href="logout.php"><button>Se deconnecter</button></a>
		<div class="topnav">
			<a href="ajout_prof.php">ajouter un professeur</a>
  		<a href="ajout_sceance.php"> ajouter une seance</a>
  		<a href="lister_profs.php">lister les professeurs</a>
  		<a href="emp_admin.php">Emploi de temps</a>
  		<a href="tableau_bord.php">Tableu de bord</a>
			<a href="check_emploi.php">Verifier les cours</a>
	 </div>

		<form action='emp_admin.php' method='GET'>
			<h1>Afficher l'emploi de temps :</h1>
				<label for="Nom">Annee Scolaire :</label>
				<input type="number" name="annee_scolaire" <?php if ($ok) {echo " value='".$_GET["annee_scolaire"]."'";} ?>>

				<label for="Nom">Semestre :</label>
				<select name="semestre">
						<option value="s1" <?php if ($ok) if ($_GET["semestre"]=="s1") echo " selected"; ?>>S1</option>
						<option value="s2" <?php if ($ok) if ($_GET["semestre"]=="s2") echo " selected"; ?>>S2</option>
						<option value="s3" <?php if ($ok) if ($_GET["semestre"]=="s3") echo " selected"; ?>>S3</option>
						<option value="s4" <?php if ($ok) if ($_GET["semestre"]=="s4") echo " selected"; ?>>S4</option>
						<option value="s5" <?php if ($ok) if ($_GET["semestre"]=="s5") echo " selected"; ?>>S5</option>
				</select>


				<label for="Periode">Periode :</label>
				<select name="periode">
						<option value="t1" <?php if ($ok) if ($_GET["periode"]=="t1") echo " selected"; ?>>Trimestre 1</option>
						<option value="t2" <?php if ($ok) if ($_GET["periode"]=="t2") echo " selected"; ?>>Trimestre 2</option>
				</select>
			<br>


				<label for="Periode">Filiere :</label>
				<select name="filiere">
						<option value="info" <?php if ($ok) if ($_GET["filiere"]=="info") echo " selected"; ?>>Info</option>
						<option value="af" <?php if ($ok) if ($_GET["filiere"]=="af") echo " selected"; ?>>A-F</option>
						<option value="se" <?php if ($ok) if ($_GET["filiere"]=="se") echo " selected"; ?>>S-E</option>
						<option value="sd" <?php if ($ok) if ($_GET["filiere"]=="sd") echo " selected"; ?>>S-D</option>
						<option value="road" <?php if ($ok) if ($_GET["filiere"]=="road") echo " selected"; ?>>ROAD</option>
				</select>


				<label for="Periode">Niveau :</label>
				<select name="niveau">
						<option value="a1" <?php if ($ok) if ($_GET["niveau"]=="a1") echo " selected"; ?>>Premiere annee</option>
						<option value="a2" <?php if ($ok) if ($_GET["niveau"]=="a2") echo " selected"; ?>>Deuxieme annee</option>
						<option value="a3" <?php if ($ok) if ($_GET["niveau"]=="a3") echo " selected"; ?>>Troisieme annee</option>
				</select>


				<label for="Periode">Groupe :</label>
				<select name="groupe">
						<option value="g1" <?php if ($ok) if ($_GET["groupe"]=="g1") echo " selected"; ?>>Groupe 1</option>
						<option value="g2" <?php if ($ok) if ($_GET["groupe"]=="g2") echo " selected"; ?>>Groupe 2</option>
						<option value="g3" <?php if ($ok) if ($_GET["groupe"]=="g3") echo " selected"; ?>>Groupe 3</option>
						<option value="g4" <?php if ($ok) if ($_GET["groupe"]=="g4") echo " selected"; ?>>Groupe 4</option>
						<option value="g5" <?php if ($ok) if ($_GET["groupe"]=="g5") echo " selected"; ?>>Groupe 5</option>
						<option value="g6" <?php if ($ok) if ($_GET["groupe"]=="g6") echo " selected"; ?>>Groupe 6</option>
						<option value="g7" <?php if ($ok) if ($_GET["groupe"]=="g7") echo " selected"; ?>>Groupe 7</option>
						<option value="g8" <?php if ($ok) if ($_GET["groupe"]=="g8") echo " selected"; ?>>Groupe 8</option>
				</select><br>



				<button type="submit" value="Valider">Valider</button>

		</form>
		<table border="1" style="background: rgba(255,255,255,0.1); " align="center" id="cours">
			<tr>
				<th></th>
				<th>8h-10h</th>
				<th>10h-12h</th>
				<th>14h-16h</th>
				<th>16h-18h</th>
			</tr>

			<tr>
				<td>Lundi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

			<tr>
				<td>Mardi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

			<tr>
				<td>Mercredi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

			<tr>
				<td>Jeudi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

			<tr>
				<td>Vendredi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

			<tr>
				<td>Samedi</td>
				<?php
					$jour++;$heure=8;
					for ($i=0; $i < 4; $i++) {
				?>

				<td>
					<?php
					if(isset($cours[$jour][$heure])){
						afficheCours($cours[$jour][$heure]);
					}
					$heure +=2;
					?>
				</td>
				<?php } ?>
			</tr>

		</table>
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
