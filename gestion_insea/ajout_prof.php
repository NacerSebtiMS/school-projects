<!doctype>

<html>
<head>
		<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Ajouter professeur</title>
			<link rel="stylesheet" href="css/normalize.css">
			<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/main.css">
</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
	include("Connexion_BdD.php");
	if ( isset($_POST["nom_prof"]) && $_POST["nom_prof"] != ""
		&& isset($_POST["prenom_prof"]) && $_POST["prenom_prof"] != ""
		&& isset($_POST["salaire"]) && $_POST["salaire"] != ""
		&& isset($_POST["statut"]) && $_POST["statut"] != ""
		&& isset($_POST["telephone"]) && $_POST["telephone"] != ""
		&& isset($_POST["email"]) && $_POST["email"] != ""
		&& isset($_POST["sexe"]) && $_POST["sexe"] != ""
	) {
		if ($_POST["statut"] == "vacataire") {
			$req = "INSERT INTO professeur (nom_prof,prenom_prof,salaire_prof,statut_prof,tel_prof,email_prof,sexe_prof) VALUES (
					'".$_POST["nom_prof"]."',
					'".$_POST["prenom_prof"]."',
					0,
					'".$_POST["statut"]."',
					'".$_POST["telephone"]."',
					'".$_POST["email"]."',
					'".$_POST["sexe"]."')";
		} else {
			$req = "INSERT INTO professeur (nom_prof,prenom_prof,salaire_prof,statut_prof,tel_prof,email_prof,sexe_prof) VALUES (
						'".$_POST["nom_prof"]."',
						'".$_POST["prenom_prof"]."',
						".$_POST["salaire"].",
						'".$_POST["statut"]."',
						'".$_POST["telephone"]."',
						'".$_POST["email"]."',
						'".$_POST["sexe"]."')";
		}
		$ajout = mysqli_query($db, $req);
		if ($ajout) {
			echo "Ajout avec succes";
		} else {
			echo "Erreur";
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
		<form action='ajout_prof.php' method='POST'>

			Nom : <input type="text" name="nom_prof"><br>
			Prenom : <input type="text" name="prenom_prof"><br>
			Salaire : <input type="number" name="salaire"><br>

			Statut :
			<select name="statut">
				<option value="vacataire">Vacataire</option>
				<option value="permanent">Permanent</option>
			</select><br>

			Telephone : <input type="text" name="telephone"><br>
			Email : <input type="text" name="email"><br>

			Sexe :
			<select name="sexe">
				<option value="f">Femme</option>
				<option value="h">Homme</option>
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
</style>
