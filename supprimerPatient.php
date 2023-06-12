<?php 

	include 'identifiantBDD.php';
	include 'verifConnecte.php';

	if(isset($_GET['id'])){
		include 'connexionBDD.php';
		$id = htmlspecialchars($_GET['id']);
		
		$requete = $linkpdo->prepare('DELETE FROM Patient WHERE IdPatient = :idP');
		$requete->execute(array('idP'=>$id));
	}

	header("location:recherchePatient.php")
?>