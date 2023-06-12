<?php 
	include 'identifiantBDD.php';
	include 'verifConnecte.php';

	if(isset($_GET['dateC'],$_GET['heure'],$_GET['id'])){

		include'connexionBDD.php';
		$requete = $linkpdo->prepare('DELETE FROM rendezvous WHERE DateConsultation = :dateC AND HeureDebutConsultation = :heure AND IdMedecin = :id');

		$requete->execute(array('dateC'=>$_GET['dateC'],
								'heure'=>$_GET['heure'],
								'id'=>$_GET['id']));
	}
	header("location:consultation.php")

?>