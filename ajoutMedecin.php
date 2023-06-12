<?php 
	include 'verifConnecte.php';
?>
<html>
<!DOCTYPE html>
<title>Ajouter un médecin</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<h1>Saisie d'un médecin</h1>
	<form action="ajoutMedecinTraitement.php" method="post" style="width:60%;">
		<input type="radio" name="civilite" value="M" checked="checked">Homme
		<input type="radio" name="civilite" value="Mme">Femme<br/>
		<input type="text" name ="nom" placeholder ="Nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'" required><br/>
		<input type="text" name ="prenom" placeholder ="Prénom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Prénom'" required><br/><br>
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
</style>