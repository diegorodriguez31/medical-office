<?php 
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	include 'verifConnecte.php';

	if(!isset($_POST['nb'])){
		$nb = 0;
	}else {
		$nb = $_POST['nb'];
	}
	
	if(!empty($_POST['idpat'])){
		$reqRef = $linkpdo->prepare("SELECT IdMedecin FROM Patient WHERE IdPatient=".$_POST['idpat']);
		$reqRef->execute();
		$idMedecinSelected = $reqRef->fetchAll()[0]['IdMedecin'];
	}
	if(isset($_POST['dater'],$_POST['heure'],$_POST['idpat'],$_POST['idmed'],$_POST['duree'])){
		//cas ou l'heure de début est durant une autre consultation et cas ou l'heure de fin est durant une autre consultation
		$requeteVerif = $linkpdo-> prepare('SELECT count(*) FROM rendezvous WHERE IdMedecin = :idMed AND DateConsultation = :dateC AND (:heure BETWEEN HeureDebutConsultation AND ADDTIME(HeureDebutConsultation,sec_to_time(DureeConsultation * 60)) OR ADDTIME(:heure,sec_to_time(:duree*60)) BETWEEN HeureDebutConsultation AND ADDTIME(HeureDebutConsultation,sec_to_time(DureeConsultation * 60)))');
		$requeteVerif->execute(array('idMed'=> $_POST['idmed'],
									 'dateC'=> $_POST['dater'],
									 'heure'=> $_POST['heure'],
									 'duree'=> $_POST['duree']));
		$res = $requeteVerif->fetch();
        if($res['count(*)']>0){
        	header('location:saisirRdv.php?erreur=1');
        	exit;
        }


		$requete = $linkpdo->prepare('INSERT INTO rendezvous (DateConsultation, HeureDebutConsultation, DureeConsultation, IdPatient, IdMedecin) VALUES (:dater, :heure, :duree,:idpat, :idmed)');
		$requete->execute(array(
						'dater' => $_POST['dater'],
						'heure' => $_POST['heure'],
						'duree' => $_POST['duree'],
						'idpat' => $_POST['idpat'],
						'idmed' => $_POST['idmed']));
		if(!empty($_POST['valider']))
			header('location:consultation.php');
	}
?>

<html>
<!DOCTYPE html>
<title>Saisir un rendez-vous</title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 220px;">
<h1>Saisir un rendez-vous</h1><br>
<?php if(isset($_GET['erreur'])) echo "<p style='color:red; text-align:center;'><strong>Attention : ce médecin a déjà un rendez-vous à cette heure-ci</strong></p>"?>

<form action="saisirRdv.php" method="post" style="width:60%;">
		Date : <input type="date" name="dater" value = <?php if(isset($_POST['dater'])) echo "$_POST[dater]"; else echo date("Y-m-d"); ?>><br>
		Heure : <input type="time" name ="heure" <?php if(isset($_POST['heure'])) echo "value = $_POST[heure]"; ?> required><br> 
		Patient :
		<select onchange="this.form.submit()" name ="idpat">
			<?php
				if($nb === 0){
					echo "<option selected>Selectionnez un patient</option>";
					$nb += 1;
				}
				$requete = $linkpdo->prepare('SELECT * FROM Patient');
				$requete->execute();

				while ($row = $requete->fetch()){
					if(!empty($_POST['idpat']) && $_POST['idpat'] == $row['IdPatient'] && $nb > 0){
						echo "<option selected value=".$row['IdPatient'].">".$row['Prenom']." ".$row['Nom']."</option>";
					} else {
						echo "<option value=".$row['IdPatient'].">".$row['Prenom']." ".$row['Nom']."</option>";
					}
				} 

			?>
		</select><br>
		Médecin :
		<select name ="idmed">
			<?php 
				$requete = $linkpdo->prepare('SELECT * FROM Medecin');
				$requete->execute();

				if($_POST['idpat'])
				while ($row = $requete->fetch()){
					if( !empty($_POST['idpat']) && $idMedecinSelected == $row['IdMedecin']){
						echo "<option selected value=".$row['IdMedecin'].">".$row[Prenom]." ".$row[Nom]."</option>";
					} else {
						echo "<option value=".$row['IdMedecin'].">".$row[Prenom]." ".$row[Nom]."</option>";
					}
				} 

			?>
		</select><br>
		Durée (en min): 
		<input type="number" name="duree" min="00:01" value="30" required><br>
		<input type="hidden" name="nb" value=<?php echo $nb; ?>><br>
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
	margin-bottom:-130px;
}
</style>