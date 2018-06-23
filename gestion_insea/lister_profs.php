<!doctype>

<html>
		<head>
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
		<title>Lister les professeurs :</title>
	</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {

	include("Connexion_BdD.php");

	$req = "SELECT CONCAT(p.nom_prof,' ',p.prenom_prof) np_prof,p.statut_prof statut_prof, p.salaire_prof salaire, count(et.id_emploi_temps)*1000 salaireVac
			FROM emploi_temps et, professeur p
			WHERE p.id_prof=et.professeur
				AND  p.statut_prof like 'vacataire'
				AND  et.etat_seance like 'confirme'
				AND  et.jour >= CONCAT('".'"'."',EXTRACT(YEAR FROM CURRENT_DATE()),'-',EXTRACT(MONTH FROM CURRENT_DATE()),'-01".'"'."')
				AND et.jour <= CURRENT_DATE()
	    	UNION
	    	SELECT CONCAT(p.nom_prof,' ',p.prenom_prof) np_prof,p.statut_prof statut_prof, p.salaire_prof salaire, p.salaire_prof salaireVac
	    	FROM professeur p
	    	WHERE p.statut_prof like 'permanent'";
	$res = mysqli_query($db, $req);
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
		<h1> Liste des professeurs </h1>
		<form action='lister_prof.php' method='POST'>

		</form>
		<br>
		<table border="1" align=center>
			<tr>
				<th>Professeur</th>
				<th>Statut</th>
				<th>Salaire</th>
			</tr>
			<?php
			foreach ($res as $data) {
				if(!is_null($data["np_prof"])){?>
			<tr>
				<td>
					<?php
					echo $data["np_prof"];
					?>
				</td>

				<td>
					<?php
					echo $data["statut_prof"];
					?>
				</td>

				<td>
					<?php
					if ($data["statut_prof"] == "vacataire") {
						echo $data["salaireVac"];
					} elseif ($data["statut_prof"] == "permanent") {
						echo $data["salaire"];
					}
					?>
				</td>
			</tr>
			<?php
				}
			}
			?>

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
</style>
