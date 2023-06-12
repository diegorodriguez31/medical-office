<?php

	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';

	$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE IdMedecin = :id');
	$requete = $linkpdo->execute('id'=>$_GET['id']);
	$row = $reponse->fetch();
?>

<html>
<!DOCTYPE html>
<title> Modifier un medecin </title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<h1> Modifier un medecin</h1>
	<form action="modifierMedecinTraitement.php" method="post">
		<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
		<input type="radio" name="civilite" value="M" <?php if($row['Civilite'] == 'M') echo "checked=\"checked\""; ?>>M
		<input type="radio" name="civilite" value="Mme" <?php if($row['Civilite'] == 'Mme') echo "checked=\"checked\""; ?>>Mme<br/>
		<input type="text" name ="nom" placeholder ="Nom" value = <?php echo "\"".$row['Nom']."\""; ?>><br/>
		<input type="text" name ="prenom" placeholder ="Prenom" value = <?php echo "\"".$row['Prenom']."\""; ?>><br/>
		<input type="submit" name="valider" value="Valider">
		<input type="reset" name="reset" value= "Reset">
	</form>
</html>

