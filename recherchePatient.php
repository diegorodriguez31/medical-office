<?php	
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';
?>

<html>
<!DOCTYPE html>
<title> Rechercher un patient </title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">


<body style="margin-top: 220px;">
<h1>Rechercher un patient</h1>
	<form action="recherchePatient.php" method="post" style="width: 60%;">
		<input type="radio" name="civilite" value="M" checked="checked">Homme
		<input type="radio" name="civilite" value="Mme">Femme<br/>
		<input type="text" name ="nom" placeholder ="Nom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nom'" ><br/>
		<input type="text" name ="prenom" placeholder ="Prénom" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Prénom'" ><br/>
		<input type="text" name="adresse" placeholder ="Adresse" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adresse'" ><br/>
		<input type="text" name="cp" placeholder ="Code postal" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Code postal'" ><br/>
		<input type="text" name="ville" placeholder ="Ville" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Ville'" ><br/>
		<input type="date" name="daten" placeholder ="Date"><br/>
		<input type="text" name="lieun" placeholder ="Lieu de naissance" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Lieu de naissance'" ><br/>
		<input type="text" name="numsecu" placeholder ="Numéro de sécurité sociale" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Numéro de sécurité sociale'" ><br/>
		<select name ="idmed">
			<option value="null">Pas de medecin referent</option>
			<?php 
				$requete = $linkpdo->prepare('SELECT * FROM Medecin');
				$requete->execute();

				while ($row = $requete->fetch()){
					echo "<option value=$row[IdMedecin]>".$row[Nom]." ".$row[Prenom]."</option>";
				}

			?>
		</select><br><br>
		<input type="reset" name="reset" value= "Reset">
		<input type="submit" name="afficher" value= "Afficher tous les patients" style="width:50%; margin-left: 25%">
		<input type="submit" name="valider" value="Valider">
	</form>
</body>


<style>
table,th,td{
	border : 1px solid black;
}

body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}

footer{
	margin-bottom: -730px;
}

</style>

 <table style="width:90%">
  <tr>
    <th>Civilité</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Adresse</th>
    <th>Code postal</th>
    <th>Ville</th>
    <th>Date de naissance</th>
    <th>Lieu de naissance</th>
    <th>Numéro de sécurité sociale</th>
    <th>Médecin traitant</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tr>





<?php

	$requete = 'SELECT *,date_format(DateNaissance,"%d/%m/%Y") as DateNaissanceFormat FROM Patient WHERE ';
if(empty($_POST['afficher'])){ 
	if(!empty($_POST['civilite']))
		$requete.= 'Civilite = "'.$_POST['civilite'].'" and ';
	if(!empty($_POST['nom']))
		$requete.= 'Nom = "'.$_POST['nom'].'" and ';
	if(!empty($_POST['prenom']))
		$requete.= 'Prenom = "'. $_POST['prenom'] .'" and ';
	if(!empty($_POST['adresse']))
		$requete.= 'Adresse = "'.$_POST['adresse'].'" and ';
	if(!empty($_POST['cp']))
		$requete.= 'CodePostal = "'. $_POST['cp'].'" and ';
	if(!empty($_POST['ville']))
		$requete.= 'Ville ="'. $_POST['ville'].'" and ';
	if(!empty($_POST['daten']))
		$requete.= 'DateNaissance = "'.$_POST['daten'].'" and ';
	if(!empty($_POST['lieun']))
		$requete.= 'LieuNaissance = "'.$_POST['lieun'].'" and ';
	if(!empty($_POST['numsecu']))
		$requete.= 'NumeroSecuriteSociale = "'.$_POST['numsecu'].'" and';
	if(!empty($_POST['idmed']))
		$requete.= 'IdMedecin = "'.$_POST['idmed'].'" and';
	$requete = substr($requete,0,-4);
	$requete.= ';' ;
}else{
	//Si on clique sur "afficher tous les patients"
	$requete = 'SELECT * FROM Patient';
}
	
	$reponse = $linkpdo->query($requete);
	
	if($reponse == false)
		exit;	

	while ($row = $reponse->fetch()){?>
	    <tr>
				<td><?php echo $row['Civilite'];?></td>
                <td><?php echo $row['Nom'];?></td>
                <td><?php echo $row['Prenom'];?></td>
                <td><?php echo $row['Adresse'];?></td>
                <td><?php echo $row['CodePostal'];?></td>
                <td><?php echo $row['Ville'];?></td>
				<td><?php echo $row['DateNaissance'];?></td>
                <td><?php echo $row['LieuNaissance'];?></td>
				<td><?php echo $row['NumeroSecuriteSociale'];?></td>
				<td><?php 
					if($row['IdMedecin'] != 0) {
						$requeteMedT = 'SELECT * FROM Medecin WHERE IdMedecin = '.$row['IdMedecin'];
						$reponseMedT = $linkpdo->query($requeteMedT);
						$medt = $reponseMedT->fetch();
				 		echo $medt['Prenom']." ".$medt['Nom']; 
			 		} else{
			 			echo "Pas de medecin referent";
			 		}
			 ?></td>
		<td><a href = <?php echo "modifierPatient.php?id=".$row['IdPatient']; ?> > Modifier</a></td>
		<td><a href = 'supprimerPatient.php?id=<?php echo $row['IdPatient']?>"' onclick="return confirm('Etes-vous sûr de vouloir supprimer le patient <?php echo $row['Nom']." ".$row['Prenom']?> ?');"> Supprimer</a></td>
            </tr>
<?php  } ?>	
</table>
<input type="button" name="saisirPat" value="Ajouter un patient" onclick="window.location='ajoutPatient.php'">

    <?php include('footer.php'); ?>

</html>
