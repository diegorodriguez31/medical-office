<?php
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';
?>

<html>
<!DOCTYPE html>
<title>Statistiques des medecins</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<h1>Temps passé en consultation</h1>
<table>
	<tr>
		<td class="titre">Médecin</td>
		<td class="titre">Nombre d'heures</td>
		<td class="titre">Nombre de minutes</td>
	</tr>
	<?php 
	$requete = $linkpdo->prepare('SELECT IdMedecin, round(sum(DureeConsultation)/60,2) as dureeTotal, round(sum(DureeConsultation)) as minutes FROM rendezvous GROUP BY IdMedecin');
	$requete->execute();
	while ($row = $requete->fetch()){?>
	<tr>
		<td><?php 
			$requeteNomM = $linkpdo->prepare('SELECT Nom, Prenom FROM Medecin WHERE IdMedecin = :id');
			$requeteNomM->execute(array('id'=>$row['IdMedecin']));
			$rowMedecin = $requeteNomM->fetch();
			echo $rowMedecin['Nom'].' '.$rowMedecin['Prenom'];
		?></td>
	    <td><?php echo number_format($row['dureeTotal'],2,"."," ");?></td>
	    <td><?php echo substr(number_format($row['minutes'],2,","," "),0,-3);?></td>
	</tr>
<?php  } ?>	
</table>
</body>
    <?php include('footer.php'); ?>

</html>

<style>

body{
   	background-image: url('Images/BackAll3.jpg');
	background-size:cover;	
}

</style>