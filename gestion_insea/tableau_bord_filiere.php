<!doctype>

<html>
	<head>
		<title>Admin : Emploi du temps</title>
	</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
	include("Connexion_BdD.php");
	if (isset($_GET['filiere']) && $_GET['filiere']!='') {
		$req = "SELECT DISTINCT(et.niveau), t_c.s_c confirme, t_r.s_r reporte, t_a.s_a annule
						FROM emploi_temps et
									LEFT JOIN (SELECT niveau,COUNT(etat_seance) s_c FROM emploi_temps WHERE etat_seance like 'confirme' AND filiere ='".$_GET["filiere"]."' group by niveau) t_c ON et.niveau = t_c.niveau
									LEFT JOIN (SELECT niveau,COUNT(etat_seance) s_a FROM emploi_temps WHERE etat_seance like 'annule' AND filiere ='".$_GET["filiere"]."' group by niveau) t_a ON et.niveau = t_a.niveau
									LEFT JOIN (SELECT niveau,COUNT(etat_seance) s_r FROM emploi_temps WHERE etat_seance like 'reporte' AND filiere ='".$_GET["filiere"]."' group by niveau) t_r ON et.niveau = t_r.niveau
						WHERE et.filiere ='".$_GET["filiere"]."'
						ORDER BY niveau";
	}
	$filieres = mysqli_query($db, $req);

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
		<table border="1" align=center>
			<?php
			foreach ($filieres as $data) {
				?>
				<tr>
					<td>
						<?php if ($data["niveau"] == 'a1') {
							echo "Premiere annee";
						}elseif ($data["niveau"] == 'a2') {
							echo "Deuxieme annee";
						}else {
							echo "Troisieme annee";
						} ?>
					</td>
					<td>
						<a href='tableau_bord_annee.php?niveau=<?php echo $data["niveau"]."&filiere=".$_GET["filiere"]; ?>'>
					<?php if ($data["annule"]>0) {
						echo "<img src='icons/lamps/red'>";
					}elseif($data["reporte"]>0){
						echo "<img src='icons/lamps/orange'>";
					}else{
						echo "<img src='icons/lamps/green'>";
					} ?>
				</a>
					</td>
				</tr>
				<?php } ?>

		</table>
			<a href="tableau_bord.php"><button value="Valider">Retour</button></a>
	</body>
</html>
<?php } else header("Location: login.php") ?>


	<style type="text/css">
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


		*, *:before, *:after {
		  -moz-box-sizing: border-box;
		  -webkit-box-sizing: border-box;
		  box-sizing: border-box;
		}

		body {
		  font-family: 'Nunito', sans-serif;
		  color: #384047;
		}
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
		form {
		  max-width: 300px;
		  margin: 10px auto;
		  padding: 10px 20px;
		  background: #f4f7f8;
		  border-radius: 8px;
		}
		.column {
		  float: left;
		  width: 16.67%;
		  padding: 40px;
		}

		.row::after {
		  content: "";
		  clear: both;
		  display: table;
		}

		h1 {
		  margin: 0 0 30px 0;
		  text-align: center;
		}

		input[type="text"],
		input[type="password"],
		input[type="date"],
		input[type="datetime"],
		input[type="email"],
		input[type="number"],
		input[type="search"],
		input[type="tel"],
		input[type="time"],
		input[type="url"],
		textarea,
		select {
		  background: rgba(255,255,255,0.1);
		  border: none;
		  font-size: 16px;
		  height: auto;
		  margin: 0;
		  outline: 0;
		  padding: 15px;
		  width: 100%;
		  background-color: #e8eeef;
		  color: #8a97a0;
		  box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
		  margin-bottom: 30px;
		}

		input[type="radio"],
		input[type="checkbox"] {
		  margin: 0 4px 8px 0;
		}

		select {
		  padding: 6px;
		  height: 32px;
		  border-radius: 2px;
		}

		button {
		  padding: 19px 39px 18px 39px;
		  color: #FFF;
		  background-color: #4bc970;
		  font-size: 18px;
		  text-align: center;
		  font-style: normal;
		  border-radius: 5px;
		  width: 100%;
		  border: 1px solid #3ac162;
		  border-width: 1px 1px 3px;
		  box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
		  margin-bottom: 10px;
		}

		fieldset {
		  margin-bottom: 30px;
		  border: none;
		}

		legend {
		  font-size: 1.4em;
		  margin-bottom: 10px;
		}

		label {
		  display: block;
		  margin-bottom: 8px;
		}

		label.light {
		  font-weight: 300;
		  display: inline;
		}

		.number {
		  background-color: #5fcf80;
		  color: #fff;
		  height: 30px;
		  width: 30px;
		  display: inline-block;
		  font-size: 0.8em;
		  margin-right: 4px;
		  line-height: 30px;
		  text-align: center;
		  text-shadow: 0 1px 0 rgba(255,255,255,0.2);
		  border-radius: 100%;
		}

		@media screen and (min-width: 480px) {

		  form {
		    max-width: 480px;
		  }

		}
	</style>
