<?php
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
    include 'verifConnecte.php';
?>

<html>
<!DOCTYPE html>
<title>Afficher les rendez-vous</title>
<head>
  <?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<div class=titrePage>
  <h1>Affichage des rendez-vous</h1>
</div>
<?php if(isset($_GET['erreur'])) echo "Attention ce medecin a deja un rendez-vous à cette heure-ci";?>
 <table style="width:70%; height:60%;">
  <tr>
    <th>Date</th>
    <th>Heure</th>
    <th>Duree (en minutes)</th>
    <th>Medecin</th>
    <th>Patient</th>
    <th>Modifier</th>
    <th>Supprimer</th>
  </tr>
</body>

<style>
table, th, td{
	border : 1px solid black;
}

td{
  text-align:center;
}

body{
   background-image: url('Images/BackAll3.jpg');
   background-size:cover;
}

footer{
  margin-bottom: -40px;
}

</style>

<?php

	$requete = $linkpdo->prepare('SELECT *, date_format(DateConsultation,"%d/%m/%Y") as DateConsultationFormat, date_format(HeureDebutConsultation,"%h:%i") as HeureDebutConsultationFormat FROM rendezvous ORDER BY DateConsultation DESC, HeureDebutConsultation DESC');
	//Date_format permet de mettre un format plus  conventionnel

	$requete->execute();
	
	while ($row = $requete->fetch()){?>
	    <tr>
    		<td><?php echo $row['DateConsultationFormat'];?></td>
            <td><?php echo $row['HeureDebutConsultationFormat'];?></td>
            <td><?php echo $row['DureeConsultation'];?></td>
            <td><?php 
               	$requeteMedecin = $linkpdo->prepare('SELECT Nom,Prenom FROM Medecin WHERE IdMedecin = :id');
               	$requeteMedecin->execute(array('id'=>$row['IdMedecin']));
               	$reqMFetch = $requeteMedecin->fetch();
               	echo $reqMFetch['Nom']." ".$reqMFetch['Prenom'];
            ?></td>
            <td><?php 
               	$requetePatient = $linkpdo->prepare('SELECT Nom,Prenom FROM Patient WHERE IdPatient = :id');
               	$requetePatient->execute(array('id'=>$row['IdPatient']));
               	$reqPFetch = $requetePatient->fetch();
             	echo $reqPFetch['Nom']." ".$reqPFetch['Prenom'];
            ?></td>
            <td><a href = <?php echo "modifierConsultation.php?dateC=".$row['DateConsultation']."&heure=".$row['HeureDebutConsultation']."&id=".$row['IdMedecin']; ?> > Modifier<br/></a></td>
            <td><a href = 'supprimerConsultation.php?dateC=<?php echo $row['DateConsultation'].'&heure='.$row['HeureDebutConsultation'].'&id='.$row['IdMedecin']?>"' onclick="return confirm('Etes-vous sûr de vouloir supprimer la consultation ?');"> Supprimer</a></td>
    </tr>
<?php  } ?>	
</table>
<input type="button" name="saisirRdv" value="Saisir un rendez-vous" onclick="window.location='saisirRdv.php'">
    <?php include('footer.php'); ?>
</html>