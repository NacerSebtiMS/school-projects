<!doctype>

<html>
	<head>
		<title>Etat des seances</title>
	</head>
<?php
	session_start();
	if (isset($_SESSION['type']) && $_SESSION['type'] == 'a') {
	include("Connexion_BdD.php");
	$ok=0;
	function afficheCours($c){
		echo $c["element"]."<br>";
	}

	if ( isset($_GET["annee_scolaire"]) && $_GET["annee_scolaire"] != ""
		&& isset($_GET["semestre"]) && $_GET["semestre"] != ""
		&& isset($_GET["periode"]) && $_GET["periode"] != ""
		&& isset($_GET["filiere"]) && $_GET["filiere"] != ""
		&& isset($_GET["niveau"]) && $_GET["niveau"] != ""
		&& isset($_GET["groupe"]) && $_GET["groupe"] != ""
		&& isset($_GET["jour"]) && $_GET["jour"] != ""
	) {


		$ok=1;
		$req = "SELECT et.id_emploi_temps id,et.annee_scolaire, et.semestre, et.niveau, et.periode, WEEKDAY(et.jour) j, et.heure_deb, et.heure_fin, et.element, et.salle, p.nom_prof professeur, et.groupe, et.etat_seance es, et.filiere,et.jour
				FROM emploi_temps et, professeur p
				WHERE et.professeur = p.id_prof
						AND annee_scolaire = ".	$_GET["annee_scolaire"]."
						AND semestre = '".	$_GET["semestre"]."'
						AND periode = '".	$_GET["periode"]."'
						AND filiere = '".	$_GET["filiere"]."'
						AND niveau = '".	$_GET["niveau"]."'
						AND groupe = '".	$_GET["groupe"]."'
						AND jour = '".	$_GET["jour"]."'
				ORDER BY heure_deb";
		$emploi = mysqli_query($db, $req);

		if($emploi){
			foreach ($emploi as $data) {
				$j = $data["j"];
				$cours[ $data["j"] ][ $data["heure_deb"] ] = $data;
				$complete[ $data["j"] ][ $data["heure_deb"] ] = "?id=".$data['id']
						."&annee_scolaire=".$_GET["annee_scolaire"]
						."&jour=".$_GET["jour"]
						."&semestre=".$_GET["semestre"]
						."&periode=".$_GET["periode"]
						."&filiere=".$_GET["filiere"]
						."&niveau=".$_GET["niveau"]
						."&groupe=".$_GET["groupe"];
			}
		}

	}

?>
<body>
	<body>
		<a href="logout.php"><button value="Valider">Se deconnecter</button></a>
		<div class="topnav">
			<a href="ajout_prof.php">ajouter un professeur</a>
			<a href="ajout_sceance.php"> ajouter une seance</a>
			<a href="lister_profs.php">lister les professeurs</a>
			<a href="emp_admin.php">Emploi de temps</a>
			<a href="tableau_bord.php">Tableu de bord</a>
	 </div>
		<form action='check_emploi.php' method='GET'>

			Annee Scolaire : <input type="number" name="annee_scolaire" <?php if ($ok) {echo " value='".$_GET["annee_scolaire"]."'";} ?>>

			Semestre :
			<select name="semestre">
				<option value="s1" <?php if ($ok) if ($_GET["semestre"]=="s1") echo " selected"; ?>>S1</option>
				<option value="s2" <?php if ($ok) if ($_GET["semestre"]=="s2") echo " selected"; ?>>S2</option>
				<option value="s3" <?php if ($ok) if ($_GET["semestre"]=="s3") echo " selected"; ?>>S3</option>
				<option value="s4" <?php if ($ok) if ($_GET["semestre"]=="s4") echo " selected"; ?>>S4</option>
				<option value="s5" <?php if ($ok) if ($_GET["semestre"]=="s5") echo " selected"; ?>>S5</option>
			</select>

			Periode :
			<select name="periode">
				<option value="t1" <?php if ($ok) if ($_GET["periode"]=="t1") echo " selected"; ?>>Trimestre 1</option>
				<option value="t2" <?php if ($ok) if ($_GET["periode"]=="t2") echo " selected"; ?>>Trimestre 2</option>
			</select><br>

			Filiere :
			<select name="filiere">
				<option value="info" <?php if ($ok) if ($_GET["filiere"]=="info") echo " selected"; ?>>Info</option>
				<option value="af" <?php if ($ok) if ($_GET["filiere"]=="af") echo " selected"; ?>>A-F</option>
				<option value="se" <?php if ($ok) if ($_GET["filiere"]=="se") echo " selected"; ?>>S-E</option>
				<option value="sd" <?php if ($ok) if ($_GET["filiere"]=="sd") echo " selected"; ?>>S-D</option>
				<option value="road" <?php if ($ok) if ($_GET["filiere"]=="road") echo " selected"; ?>>ROAD</option>
			</select>

			Niveau :
			<select name="niveau">
				<option value="a1" <?php if ($ok) if ($_GET["niveau"]=="a1") echo " selected"; ?>>Premiere annee</option>
				<option value="a2" <?php if ($ok) if ($_GET["niveau"]=="a2") echo " selected"; ?>>Deuxieme annee</option>
				<option value="a3" <?php if ($ok) if ($_GET["niveau"]=="a3") echo " selected"; ?>>Troisieme annee</option>
			</select>

			Groupe :
			<select name="groupe">
				<option value="g1" <?php if ($ok) if ($_GET["groupe"]=="g1") echo " selected"; ?>>Groupe 1</option>
				<option value="g2" <?php if ($ok) if ($_GET["groupe"]=="g2") echo " selected"; ?>>Groupe 2</option>
				<option value="g3" <?php if ($ok) if ($_GET["groupe"]=="g3") echo " selected"; ?>>Groupe 3</option>
				<option value="g4" <?php if ($ok) if ($_GET["groupe"]=="g4") echo " selected"; ?>>Groupe 4</option>
				<option value="g5" <?php if ($ok) if ($_GET["groupe"]=="g5") echo " selected"; ?>>Groupe 5</option>
				<option value="g6" <?php if ($ok) if ($_GET["groupe"]=="g6") echo " selected"; ?>>Groupe 6</option>
				<option value="g7" <?php if ($ok) if ($_GET["groupe"]=="g7") echo " selected"; ?>>Groupe 7</option>
				<option value="g8" <?php if ($ok) if ($_GET["groupe"]=="g8") echo " selected"; ?>>Groupe 8</option>
			</select>
            Date : <input type="date" name="jour" <?php if ($ok) {echo " value='".$_GET["jour"]."'";} ?>>
			<br><br>

			<input type="submit" name="" value="Valider">
			</form>
			<table border="1" align=center>

				<?php /*
					$jour++;$heure=8;$a=0;
					for ($i=0; $i <= 4; $i++) {
					if(isset($cours[$jour][$heure])){
						if($a==0) {?>
						<tr>
				            <th>heure</th>
				            <th>Element</th>
			             	<th>confermer</th>
			        	</tr>
                        <?php $a=1;
						}

					?> <tr>
					        <td><?php echo strval($heure)."h-".strval($heure+2)."h";?></td>
					        <td><?php afficheCours($cours[$jour][$heure]); ?></td>
					        <td><a href="conf_cours.php?id=<?php echo $_GET["id_emploi_temps"];?>"> C </a></td>
					   </tr>
					   <?php
					}
					$heure +=2;}
					if($a==0) echo "Pas de seance dans cette Date";*/
					?>


						<tr>
				            <th>Heure</th>
				            <th>Element</th>
			             	<th>Confirmer</th>
			        	</tr>
			        	<?php if(isset($j)){?>
                        <tr>
					        <td>8h - 10h</td>
					        <td><?php if(isset($cours[$j][8])) afficheCours($cours[$j][8]); ?></td>
					        <td>
					        <?php
					        	if(isset($cours[$j][8])){?>
					        		<a href="conf_cours.php<?php  echo $complete[$j][8];?>"> C </a>
					        		<a href="report_cours.php<?php echo $complete[$j][8];?>"> R </a>
					        		<a href="annuler_cour.php<?php echo $complete[$j][8];?>"> A </a>
					        <?php
					        	}
					        ?>
					        </td>

					   </tr>

					   <tr>
					        <td>10h - 12h</td>
					        <td><?php if(isset($cours[$j][10])) afficheCours($cours[$j][10]); ?></td>
					        <?php
					        	if(isset($cours[$j][10])){?>
					        		<td><a href="conf_cours.php<?php  echo $complete[$j][10];?>"> C   </a>
					        		<a href="report_cours.php<?php echo $complete[$j][10];?>"> R  </a>
					        		<a href="annuler_cour.php<?php echo $complete[$j][10];?>"> A  </a></td>
					        <?php
					        	}
					        ?>
					   </tr>

					   <tr>
					        <td>14h - 16h</td>
					        <td><?php if(isset($cours[$j][14])) afficheCours($cours[$j][14]); ?></td>
					        <td>
					        <?php
					        	if(isset($cours[$j][14])){?>
					        		<a href="conf_cours.php<?php  echo $complete[$j][14];?>"> C </a>
					        		<a href="report_cours.php<?php echo $complete[$j][14];?>"> R </a>
					        		<a href="annuler_cour.php<?php echo $complete[$j][14];?>"> A </a>
					        <?php
					        	}
					        ?>
					        </td>

					   </tr>

					   <tr>
					        <td>16h - 18h</td>
					        <td><?php if(isset($cours[$j][16])) afficheCours($cours[$j][16]); ?></td>
					        <td>
					        <?php
					        	if(isset($cours[$j][16])){?>
					        		<a href="conf_cours.php<?php  echo $complete[$j][16];?>"> C </a>
					        		<a href="report_cours.php<?php echo $complete[$j][16];?>"> R </a>
					        		<a href="annuler_cour.php<?php echo $complete[$j][16];?>"> A </a>

					        <?php
					        	}
					        ?>
					        </td>
					   </tr>

					   <?php
					        	}
					        ?>



			</table>

<?php } else header("Location: login.php") ?>
</body>
</html>
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
