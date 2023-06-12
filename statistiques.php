<?php
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';
?>

<html>
<!DOCTYPE html>
<title>Statistiques des patients</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<h1>Statistiques des patients</h1>
	<table>
		<tr>
		    <td class="titre">Tranches d'âge</td>
		    <td class="titre">Nombre d'hommes</td>
		    <td class="titre">Nombre de femmes</td>
		</tr>
		<tr>
		    <td class="titre">Moins de 25 ans</td>
		    <td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) < 25*365 AND Civilite = \'M\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		   	<td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) < 25*365 AND Civilite = \'Mme\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		</tr>
		<tr>
		    <td class="titre">Entre 25 et 50 ans</td>
		   	<td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) >= 25*365 AND DATEDIFF(sysdate(),DateNaissance) <= 50*365 AND Civilite = \'M\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		   	<td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) >= 25*365 AND DATEDIFF(sysdate(),DateNaissance) <= 50*365 AND Civilite = \'Mme\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		</tr>
		<tr>
		    <td class="titre">Plus de 50 ans</td>
		   	<td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) > 50*365 AND Civilite = \'M\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		   	<td><?php
			    $requete = $linkpdo->prepare('SELECT count(*) FROM Patient WHERE DATEDIFF(sysdate(),DateNaissance) > 50*365 AND Civilite = \'Mme\'');
				$requete->execute();
				echo $requete->fetch()[0];
		    ?></td>
		</tr>
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