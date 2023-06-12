<?php

	include 'identifiantBDD.php';
	include 'verifConnecte.php';

	try{
		$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}

	$requete = $linkpdo->prepare('SELECT * FROM Patient WHERE IdPatient = :id');
	$requete->execute(array('id'=>$_GET['id']));
	$row = $requete->fetch();
	$idmed = $row['IdMedecin'];
?>

<html>
<!DOCTYPE html>
<title> Modifier un patient </title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<style>
body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}
</style>


<h1> Modifier un patient</h1>
	<form action="modifierPatientTraitement.php" method="post">
		<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
		<input type="radio" name="civilite" value="M" <?php if($row['Civilite'] == 'M') echo "checked=\"checked\""; ?>>M
		<input type="radio" name="civilite" value="Mme" <?php if($row['Civilite'] == 'Mme') echo "checked=\"checked\""; ?>>Mme<br/>
		<input type="text" name ="nom" placeholder ="Nom" value = <?php echo "\"".$row['Nom']."\""; ?>><br/>
		<input type="text" name ="prenom" placeholder ="Prenom" value = <?php echo "\"".$row['Prenom']."\""; ?>><br/>
		<input type="text" name="adresse" placeholder ="Adresse" value = <?php echo  "\"".$row['Adresse']."\""; ?>><br/>
		<input type="text" name="cp" placeholder ="Code postal" maxlength = 13 value = <?php echo "\"".$row['CodePostal']."\""; ?>><br/>
		<input type="text" name="ville" placeholder ="Ville" value = <?php echo "\"".$row['Ville']."\""; ?>><br/>
		<input type="date" name="daten" value = <?php echo "\"".$row['DateNaissance']."\""; ?>><br/>
		<input type="text" name="lieun" placeholder ="Lieu de naissance" value = <?php echo "\"".$row['LieuNaissance']."\""; ?>><br/>
		<input type="text" name="numss" placeholder ="Numero de securite sociale" maxlength = 13 value = <?php echo "\"".$row['NumeroSecuriteSociale']."\""; ?>><br/>
		<select name ="idmed">
			<option value="0">Pas de medecin referent</option>
			<?php 
				$requete = 'SELECT * FROM Medecin';
				$reponse = $linkpdo->query($requete);
				
				if($reponse == false)
					echo "erreur, veuillez recharger la page";

				while ($row = $reponse->fetch()){
					$s =  "<option value=\"$row[IdMedecin]\"";
					if($row['IdMedecin'] == $idmed){
						$s .= " selected ";
					}

					$s.= ">".$row[Nom]." ".$row[Prenom]."</option>";
					echo $s;
				} 

			?>
		</select><br>
		<input type="submit" name="valider" value="Valider">
		<input type="reset" name="reset" value= "Reset">
	</form>
</html>

