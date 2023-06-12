<?php 
	include 'verifConnecte.php';
	include 'identifiantBDD.php';
	include 'connexionBDD.php';
	#On vérifie si la consultation existe
	if(isset($_GET['dateC'],$_GET['heure'],$_GET['id'])){
		$requete = $linkpdo->prepare('SELECT count(*) FROM rendezvous WHERE DateConsultation = :dateC AND HeureDebutConsultation = :heure AND IdMedecin = :id');
		$requete->execute(array('dateC'=>$_GET['dateC'],
								'heure' => $_GET['heure'],
								'id'=>$_GET['id']));
		if($requete->fetch()['count(*)'] == 0) {
			header('location:consultation.php');
		}
	}else {
		header('location:consultation.php');
	}
	$requete = $linkpdo->prepare('SELECT * FROM rendezvous WHERE DateConsultation = :dateC AND HeureDebutConsultation = :heure AND IdMedecin = :id');
	$requete->execute(array('dateC'=>$_GET['dateC'],
							'heure' => $_GET['heure'],
							'id'=>$_GET['id']));
	$res = $requete->fetch();
	$date = $res['DateConsultation'];
	$heure = $res['HeureDebutConsultation'];
	$idP = $res['IdPatient'];
	$idM =$res['IdMedecin'];
	$duree = $res['DureeConsultation'];	
?>

<html>
<!DOCTYPE html>
<title> Modifier une consultation </title>
<head>
	<?php include('header.php');?>
</head>
<link rel="stylesheet" href="BootStrap/css/notreStyle.css">
<body style="margin-top: 250px;">

<h1>Modifier un rendez vous</h1><br>
<form action="modifierConsultationTraitement.php" method="post">
		<input type="hidden" name="aDateC" value=<?php echo $_GET['dateC']; ?>>
		<input type="hidden" name="aHeure" value=<?php echo $_GET['heure']; ?>>
		<input type="hidden" name="aId" value=<?php echo $_GET['id']; ?>>
		Date : <input type="date" name="dater" value = <?php echo $date; ?> required><br>
		Heure : <input type="time" name ="heure" value = <?php echo $heure; ?> required><br> 
		Patient :
		<select name ="idpat">
			<?php 
				$requete = $linkpdo->prepare('SELECT IdPatient, Nom, Prenom FROM Patient');
				$requete->execute();

				while ($row = $requete->fetch()){
					$s = "<option value=".$row['IdPatient'];
					if($row['IdPatient'] == $idP){
						$s .= " selected ";
					}

					$s.= ">".$row['Nom']." ".$row['Prenom']."</option>";
					echo $s;
				} 

			?>
		</select><br>
		Médecin :
		<select name ="idmed">
			<?php 
				$requete = $linkpdo->prepare('SELECT IdMedecin, Nom, Prenom FROM Medecin');
				$requete->execute();

				while ($row = $requete->fetch()){
					$s = "<option value=".$row['IdMedecin'];
					if($row['IdMedecin'] == $idM){
						$s .= " selected ";
					}

					$s.= ">".$row['Nom']." ".$row['Prenom']."</option>";
					echo $s;
				} 

			?>
		</select><br>
		Durée (en min): 
		<input type="number" name="duree" value =<?php echo $duree;?> required><br>
		<input type="submit" name="valider" value="Valider">
		<input type="reset" name="reset" value= "Reset">
 
</form>
</html>
