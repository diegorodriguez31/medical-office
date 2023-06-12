<?php include 'verifConnecte.php'; ?>
<html>
<!DOCTYPE html>
<title>Rechercher un médecin</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<h1>Rechercher un médecin</h1>

	<form action="rechercheMedecin.php" method="post" style="width:60%;">
		<input type="text" name = "civilite" placeholder ="Civilité (M), (Mme)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Civilité (M), (Mme)'" ><br/>
		<input type="text" name ="nom" placeholder ="Nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'" ><br/>
		<input type="text" name ="prenom" placeholder ="Prénom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Prénom'" ><br/><br>
		<input type="reset" name="reset" value= "Reset">
		<input type="submit" name="afficher" value= "Afficher tous les médecin">
		<input type="submit" name="valider" value="Valider">
	</form>


 <table style="width:60%">
  <tr>
    <th>Civilité</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tr>
</body>

<style>
table, th, td{
	border : 1px solid black;
}

body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}

footer{
	margin-bottom: -350px;
}

</style>
<?php

	
	include 'identifiantBDD.php';
	include 'connexionBDD.php';

	$requete = 'SELECT * FROM Medecin WHERE '; 
	if(!empty($_POST['civilite']))
		$requete.= 'Civilite = "'.$_POST['civilite'].'" and ';
	if(!empty($_POST['nom']))
		$requete.= 'Nom = "'.$_POST['nom'].'" and ';
	if(!empty($_POST['prenom']))
		$requete.= 'Prenom = "'. $_POST['prenom'] .'" and ';
	$requete = substr($requete,0,-4);
	$requete.= ';' ;
	
	$reponse = $linkpdo->query($requete);
	
	if($reponse == false)
		exit;	

	while ($row = $reponse->fetch()){?>
	    <tr>
		<td><?php echo $row['Civilite'];?></td>
                <td><?php echo $row['Nom'];?></td>
                <td><?php echo $row['Prenom'];?></td>
		<td>	<a href = <?php echo "modifierMedecin.php?id=".$row['IdMedecin']; ?> > Modifier<br/></a></td>
		<td>	<a href = 'supprimerMedecin.php?id="<?php echo $row['IdMedecin']?>"' onclick="return confirm('Etes-vous sûr de vouloir supprimer le medecin <?php echo $row['Nom']." ".$row['Prenom']?> ?');"> Supprimer</a></td>
            </tr>
<?php  } ?>	
</table>
<input type="button" name="saisirMed" value="Ajouter un médecin" onclick="window.location='ajoutMedecin.php'">

    <?php include('footer.php'); ?>

</html>
