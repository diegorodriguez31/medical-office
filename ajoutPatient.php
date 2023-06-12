<?php
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';

?>

<html>
<!DOCTYPE html>
<title>Ajouter un patient </title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">

<body style="margin-top: 220px;">
	<h1>Ajout d'un patient</h1>
	<form action="ajoutPatientTraitement.php" style="width:60%;" method="post">
		<input type="radio" name="civilite" value="M" checked="checked">Homme
		<input type="radio" name="civilite" value="Mme">Femme<br/>
		<input type="text" name ="nom" placeholder ="Nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'" required><br/>
		<input type="text" name ="prenom" placeholder ="Prénom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Prénom'" required><br/>
		<input type="text" name="adresse" placeholder ="Adresse" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adresse'" ><br/>
		<input type="text" name="cp" maxlength = 5 pattern="[0-9]{5}" title = "Nombre à 5 chiffres" placeholder ="Code postal" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Code postal'" ><br/>
		<input type="text" name="ville" placeholder ="Ville" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ville'" ><br/>
		<input type="date" name="daten" required><br/>
		<input type="text" name="lieun" placeholder ="Lieu de naissance" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lieu de naissance'" required><br/>
		<input type="text" name="numss" maxlength = 13 pattern="[0-9]{13}" title = "Nombre à 13 chiffres" placeholder ="Numéro de sécurité sociale" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numéro de sécurité sociale'" required><br/>
		<select name ="idmed">
			<option value="0">Pas de medecin référent</option>
			<?php 
				$requete = $linkpdo->prepare('SELECT * FROM Medecin');
				$requete->execute();
				if($requete == false)
					echo "erreur, veuillez recharger la page";

				while ($row = $requete->fetch()){
					echo "<option value=\"".$row['IdMedecin']."\">".$row[Nom]." ".$row[Prenom]."</option>";
				} 

		?>
		</select><br><br>
		<input type="reset" name="reset" value= "Reset">
		<input type="submit" name="valider" value="Valider">
	</form>
</body>
    <?php include('footer.php'); ?>

</html>

<style>
body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}

footer{
	margin-bottom:-270px;
}
</style>

